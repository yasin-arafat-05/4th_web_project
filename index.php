<!--
***********************************Cute Author********************************************** 
★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆
  ██╗   ██╗ █████╗ ███████╗██╗███╗   ██╗   █████╗ ██████╗  █████╗ ███████╗ █████╗ ████████╗
  ██║   ██║██╔══██╗██╔════╝██║████╗  ██║  ██╔══██╗██╔══██╗██╔══██╗██╔════╝██╔══██╗╚══██╔══╝
  ██║   ██║███████║███████╗██║██╔██╗ ██║  ███████║██████╔╝███████║█████╗  ███████║   ██║   
  ╚██╗ ██╔╝██╔══██║╚════██║██║██║╚██╗██║  ██╔══██║██╔══██╗██╔══██║██╔══╝  ██╔══██║   ██║   
   ╚████╔╝ ██║  ██║███████║██║██║ ╚████║  ██║  ██║██║  ██║██║  ██║██║     ██║  ██║   ██║   
    ╚═══╝  ╚═╝  ╚═╝╚══════╝╚═╝╚═╝  ╚═══╝  ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝     ╚═╝  ╚═╝   ╚═╝   
★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅★⋅☆⋅   
*********************************************************************************************
Email: yasinarafat.e2021@gmail.com
Last Modification date: 19-05-25
-->

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie app</title>
    <!-- --------- link for Roboto and (font-awesome for icon) ------------------->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style/bot.css">
</head>
<body>
    <!-- __________________________Connection of PHP files___________________-->
    <?php 
        # require_once is used to import a php file(happence ones):
        require_once 'database.php';
        $movieDB = new MovieDB();
        /*foreach($action_movies as $row){
            echo "-----------------> {$row['original_title']} <br>";
        }
        */      
        $action_movies = $movieDB->getMovies(10,"Action");
        $thriller_movies = $movieDB->getMovies(10,"Thriller");
        $science_movies = $movieDB->getMovies(10,"Science Fiction");
        $romance_movies = $movieDB->getMovies(10,"Romance");
    ?>
    <!-- _____________________________ Navbar Section ______________________________ -->
    <div class="navbar">
        
        <!-- In the navbar container we they will contains theree section-->
        <div class="navbar-container">
            <div class="logo-container">
                <h1 class="logo">
                    Cinema
                </h1>
            </div>
        <!-- _________ Menu container section will contains menu of the websites_______-->
            <!-- ______ Profile containers Profile picture and other stuff relaed user _____-->
            <div class="profile-container">  
                <img class="profie-picture" src="img/profile.jpg" alt="user_profile">
                <div class="profile-text-container">
                    <span class="profile-text">Profile</span>
                    <i class="fa-solid fa-caret-down"></i>
                </div>

                <div class="menu-container"> 
                <ul class="menu-list">    
                   <li class="menu-list-item"><a class="active" href="index.php"> Home</a></li>
                   <li class="menu-list-item"><a href="#movie1234">Movies</a></li>
                   <li class="menu-list-item"><a href="#"> Series </a></li>
                   <li class="menu-list-item"><a href="#"> Popular </a></li>
                   <li class="menu-list-item"><a href="#">About Us </a></li>
                </ul>
            </div>
                <!-- ___________________ dark mood _____________________-->
                <!-- <div class="toogle">
                    <i class="fa-solid fa-moon toogle-icon"></i>
                    <i class="fa-solid fa-sun toogle-icon"></i>
                    <div class="toogle-ball"></div>
                </div> -->
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

    <!-- _____________________________ feature contenet moive infomation ______________________________ -->
    <div class="container">
        <div class="content-container">
            <!-- rgba() The linear gradient (linear-gradient(to bottom, rgba(0,0,0,0), #151515)) creates -->
            <!-- a fade effect from fully transparent (rgba(0,0,0,0)) at the top to solid black (#151515) at the bottom.-->
           <div class="feature-content"
           style="background: linear-gradient(to bottom, rgba(0,0,0,0), #151515), url('img/f-1.jpg');">
           <img class="feature-title" src="img/f-t-1.png" alt="f-t-1 image">

           <p class="feature-description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quae amet voluptatibus autem a debitis cumque aspernatur dolorem? Aut minima atque, odit repellat aperiam eos rem tempora doloremque repudiandae asperiores.
           </p>
           <button class="feature-button">WATCH NOW</button>
           </div>
            
           <div class="inner-space"></div>
           <!-- _____________________MOVIE LIST (Action) ____________________________ -->
            <div class="movie-list-container", id="movie1234">
                <h1 class="movie-list-title">ACTION MOVIES</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php foreach($action_movies as $row): ?>
                        <div class="movie-list-item">
                            <img class="movie-list-item-image" 
                            src=<?= htmlspecialchars($row['image_url']) ?>">
                            <div class = "movie-list-item-content">
                                <span class="movie-list-item-title">
                                    <?= htmlspecialchars($row['original_title'])?>
                                </span>
                            </div>
                            <p class="moive-list-item-decs">
                                <?= substr($row['overview'],0,144) . ". . ."?>
                            </p> 
                            <button 
                            onclick="window.location.href='page/movieDetails.php?id=<?= $row['movie_id'] ?>'"
                            class="movie-list-item-button">WATCH
                            </button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <i class="fa-solid fa-arrow-right-to-bracket arrow"></i>
                </div>
            </div>
            <div class="inner-space"></div>
           <!-- _____________________MOVIE LIST (Science Fiction) ____________________________ -->
           <div class="movie-list-container">
                <h1 class="movie-list-title">SCIENCE FICTION</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php foreach($science_movies as $row): ?>
                        <div class="movie-list-item">
                            <img class="movie-list-item-image" 
                            src=<?= htmlspecialchars($row['image_url']) ?>">
                            <div class = "movie-list-item-content">
                                <span class="movie-list-item-title">
                                    <?= htmlspecialchars($row['original_title'])?>
                                </span>
                            </div>
                            <p class="moive-list-item-decs">
                                <?= substr($row['overview'],0,144) . ". . ."?>
                            </p> 
                            <button 
                            onclick="window.location.href='page/movieDetails.php?id=<?= $row['movie_id'] ?>'"
                            class="movie-list-item-button">
                            WATCH</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <i class="fa-solid fa-arrow-right-to-bracket arrow"></i>
                </div>
            </div>
            <div class="inner-space"></div>
            <!-- __________________________ drak background ________________________-->
            <div class="feature-content"
            style="background: linear-gradient(to bottom, rgba(0,0,0,0), #151515), url('img/f-2.jpg');">
            <img class="feature-title" src="img/f-t-2.png" alt="f-t-1 image">

            <p class="feature-description">
                 Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quae amet voluptatibus autem a debitis cumque aspernatur dolorem? Aut minima atque, odit repellat aperiam eos rem tempora doloremque repudiandae asperiores.
            </p>
            <button class="feature-button">WATCH NOW</button>
            </div>

            <div class="inner-space"></div>
            <!-- _____________________MOVIE LIST (Thirler) ____________________________ -->
            <div class="movie-list-container">
                <h1 class="movie-list-title">THIRLER MOVIES</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php foreach($thriller_movies as $row): ?>
                        <div class="movie-list-item">
                            <img class="movie-list-item-image" 
                            src=<?= htmlspecialchars($row['image_url']) ?>">
                            <div class = "movie-list-item-content">
                                <span class="movie-list-item-title">
                                    <?= htmlspecialchars($row['original_title'])?>
                                </span>
                            </div>
                            <p class="moive-list-item-decs">
                                <?= substr($row['overview'],0,144) . ". . ."?>
                            </p> 
                            <button 
                            onclick="window.location.href='page/movieDetails.php?id=<?= $row['movie_id'] ?>'"
                            class="movie-list-item-button">WATCH</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <i class="fa-solid fa-arrow-right-to-bracket arrow"></i>
                </div>
            </div>
            <div class="inner-space"></div>

            <!-- _____________________MOVIE (Romance) ____________________________ -->
            <div class="movie-list-container">
                <h1 class="movie-list-title">ROMANTIC MOVIES</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php foreach($romance_movies as $row): ?>
                            <div class="movie-list-item">
                                <img class="movie-list-item-image" 
                                src=<?= htmlspecialchars($row['image_url']) ?>">
                                <div class = "movie-list-item-content">
                                    <span class="movie-list-item-title">
                                        <?= htmlspecialchars($row['original_title'])?>
                                    </span>
                                </div>
                                <p class="moive-list-item-decs">
                                    <?= substr($row['overview'],0,144) . ". . ."?>
                                </p> 
                                <button 
                                onclick="window.location.href='page/movieDetails.php?id=<?= $row['movie_id'] ?>'"
                                class="movie-list-item-button">
                                WATCH</button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <i class="fa-solid fa-arrow-right-to-bracket arrow"></i>
                    </div>
                </div>
        </div>
    </div>
    <div class="inner-space"></div>
      <!-- ___________________________  Chat Bot Ui _________________________ -->
      <div id="chatbot-icon">🫟</div>
    <div id="chatbot-container" class="hidden">
        <!-- chatbot-header part -->
        <div id="chatbot-header">
            <span>Cinema-Bot</span>
            <button id="close-btn">☠️</button>
        </div>
        <div id="chatbot-body">
            <div id="chatbot-messages">
            </div>
            <div id="chatbot-input-container">
                <input type="text" id="chatbot-input" 
                            placeholder="Type a message.....">
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>
    <!-- ---------------- java script ------------------------>
    <script src="app.js"> 
    </script>    
</body>
</html>


