<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie app</title>
    <!-- --------- link for Roboto and (font-awesome for icon) ------------------->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<!-- ------------------------------------------------------------------>
<!-- ----------------------PHP CONNECTION------------------------------>
<!-- ------------------------------------------------------------------>

<?php 
require_once '../database.php';
$movieDB = new MovieDB();
if (isset($_GET['id'])) {
   $movie_id = $_GET['id'];
   $api_url = "http://0.0.0.0:8000/recom/" . $movie_id;
   echo "$api_url";

   // <-----Current Movie info-----> 
   $singleMovieInfo  = $movieDB->getMoviesByIds(285);
   #print_r($singleMovieInfo);

   //------- Initialize cURL session--------
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $api_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   curl_setopt($ch, CURLOPT_VERBOSE, true);
   $verbose = fopen('php://temp', 'w+');
   curl_setopt($ch, CURLOPT_STDERR, $verbose);
   
   // Execute the request
   $response = curl_exec($ch);
   
   // Check for errors
   if(curl_errno($ch)) {
       rewind($verbose);
       $verboseLog = stream_get_contents($verbose);
       error_log("cURL Error: " . curl_error($ch) . "\nVerbose log: " . $verboseLog);
       header("Location: ../index.php");
       exit();
   }
   
   //status code and close the curl session:
   $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   if ($http_code != 200) {
       error_log("API returned HTTP code: " . $http_code);
       error_log("API Response: " . $response);
   }
   curl_close($ch);
   

   // Decode the JSON response
   $recommendations = json_decode($response, true);
   #print_r($recommendations);

   // Clean the array: we got recommdation with comma seperated value:
  // $recommendations = array_map('intval', (array)$recommendations);

   if (empty($recommendations)) {
   error_log("No valid recommendations received");
   header("Location: ../index.php");
   exit();}
   $recom = $movieDB->recommMovies($recommendations); 
   foreach($recom as $row){
    echo "<br> -----------------------> {$row['title']} <br>";
   }
   }else {
       header("Location: ../index.php");
       exit();
   }
?>
<!-- ____________________________ Navbar Section ___________________________________ -->
        <div class="navbar">
        
        <!-- In the navbar container we they will contains theree section-->
        <div class="navbar-container">
            <div class="logo-container">
                <h1 class="logo">
                    Cinema
                </h1>
            </div>
        <!-- _________ Menu container section will contains menu of the websites_______-->
            <div class="menu-container"> 
                <ul class="menu-list">    
                   <li class="menu-list-item"><a class="active" href="index.php"> Home</a></li>
                   <li class="menu-list-item"><a href="#movie1234">Movies</a></li>
                   <li class="menu-list-item"><a href="#"> Series </a></li>
                   <li class="menu-list-item"><a href="#"> Popular </a></li>
                   <li class="menu-list-item"><a href="#">About Us </a></li>
                </ul>
            </div>
            <!-- ______ Profile containers Profile picture and other stuff relaed user _____-->
            <div class="profile-container">  
                <img class="profie-picture" src="img/prokjkfile.jpg" alt="user_profile">
                <div class="profile-text-container">
                    <span class="profile-text">Profile</span>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <!-- ___________________ dark mood _____________________-->
                <div class="toogle">
                    <i class="fa-solid fa-moon toogle-icon"></i>
                    <i class="fa-solid fa-sun toogle-icon"></i>
                    <div class="toogle-ball"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- _____________________________ Side Bar Section ______________________________ -->
    <div class="sidebar">
    <a href="#"><i class="fa-solid fa-magnifying-glass sidebar-menu-icon"></i></a>
    <a href="index.php" class="active"><i class="fa-solid fa-house sidebar-menu-icon"></i></a>
    <a href="#users"><i class="fa-solid fa-users sidebar-menu-icon"></i></a>
    <a href="#bookmarks"><i class="fa-solid fa-bookmark sidebar-menu-icon"></i></a>
    <a href="#tv"><i class="fa-solid fa-tv sidebar-menu-icon"></i></a>
    <a href="#history"><i class="fa-solid fa-hourglass-start sidebar-menu-icon"></i></a>
    <a href="#cart"><i class="fa-solid fa-cart-shopping sidebar-menu-icon"></i></a>
    </div>

</body>
</html>

