<?php
class MovieDB {
    #<--------------------- Attributes ------------------------->
    private $db;
    #<-------------------------Constructor------------------------->
    public function __construct() {
        $this->connect();
    }
    
    private function connect() {
        try {
            /*
            PDO -> PHP Data Object.(To interation with database)
            Advantage:
                - sequre and prevent sql injection
            
            **Interaction with database done with 3 steps**
            - Establish Connection
            - Run Sql Query
                - query() or prepare()-> prepare more sequre
            - Close Connection
                - connection = null
            */

            # --- 01: Establish Ecoonection ---
            $this->db = new PDO('mysql:host=localhost;dbname=MOVIES', 'root', '');
            # if our database throw any error, this attribute convert it php object:
            # that's why we can using try catch.
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            #echo "database connected successfully";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    public function getMovies($limit = 7,$type) {
        $query = "SELECT F.original_title, F.movie_id, F.overview, movie_image.image_url 
        FROM (
            SELECT M.original_title, M.movie_id, M.overview 
            FROM movie M 
            INNER JOIN (
                SELECT movie_id 
                FROM movie_genres MG 
                WHERE MG.genre_id = (
                    SELECT genre_id 
                    FROM genres G 
                    WHERE G.genre_name = :type
                )
                ORDER BY RAND()
                LIMIT :limit
            ) AS T ON M.movie_id = T.movie_id
        ) AS F 
        INNER JOIN movie_image ON F.movie_id = movie_image.movie_id";

        try {
            /*
            If we use prepare() then,
            conn->prepare(query(select * from user where uesr=?) ? -> (placeholder))
            conn->bindValue(for the placeholder1)
            conn->bindValue(for the placeholder2)
            conn->execute()
            */
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':type',$type, PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            # echo "success success success success success success success success <br>";
            /*
            Fetch: parameter:
            - PDO:FETCH_ASSOC (normlly give output with index: 
            LIKE: val = k, [1] = k). It's give only: val =k
            - PDO:FETCH_NUM output like: [1] = k, [2] =l like this.
            - PDO:FETCH_BOTH: (ASSOC and NUM)
            - PDO:FETCH_OBJ: how we acees arrtibutes of a class,
            class_object->value.
            */
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            # echo "failed to fetch data failed failed failed failed failed";
            error_log("Error fetching movies: " . $e->getMessage());
            return [];
        }
    }

    
    #  #<------------------------- Fetch movie info by id ------------------------->
    public function getMoviesByIds($id_array){
        $query = "SELECT * FROM movieinfo M WHERE M.id IN (:id_array)";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_array',$id_array, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            error_log("Error fetching recommendation movie data from database" . $e->getMessage());
            return [];
        }
    }
}

// <------------- Connect with Database ----------------->
$movieDB = new MovieDB();


// echo "----------------------1. Action Movie--------------------- <br>";
// $action_movies = $movieDB->getMovies(7,"Action");
// foreach($action_movies as $row){
//     echo "-----------------> {$row['original_title']} <br>";
// }

// echo "----------------------2.Romance Movie---------------------<br>";
// $romance_movies = $movieDB->getMovies(7,"Romance");
// foreach($romance_movies as $row){
//     echo "-----------------> {$row['original_title']} <br>";
// }


// echo "----------------------3.Science Movie---------------------<br>";
// $science_movies = $movieDB->getMovies(7,"Science Fiction");
// foreach($science_movies as $row){
//     echo "-----------------> {$row['original_title']} <br>";
// }

// echo "----------------------4.Thriller Movie---------------------<br>";
// $thriller_movies = $movieDB->getMovies(7,"Thriller");
// foreach($thriller_movies as $row){
//     echo "-----------------> {$row['original_title']} <br>";
// }

?>


