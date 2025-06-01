<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema - Sign Up</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../style/auth.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
        /*
         If any one submit the from it will pass data through the post method.
         By button name:signupbutton.
        */
        if(isset($_POST['signupbutton'])){
            $username = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm-password']);
            // echo "----------> $username <br>";
            // echo "----------> $email <br>";
            // echo "----------> $password <br>";
            // echo "----------> $confirm_password <br>";
        }
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
            <div class="menu-container"> 
                <ul class="menu-list">    
                   <li class="menu-list-item"><a href="../index.php"> Home</a></li>
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


 <div class="container">
  <div class="content-container">
    <!-- ----------------------- fields for signup pages -->
    <div class="auth-container">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Join us for the best movie experience</p>
        </div>
        <!-- _____If any one submit the from it will pass data through the post method ___-->
        <!-- _____By button name:signupbutton  ___-->
         
        <form action="#" method="POST">
            <div class="form-group">
                <label for="name"><i class="fas fa-user"></i> Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePassword('password')">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            
            <div class="form-group">
                <label for="confirm-password"><i class="fas fa-lock"></i> Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <span class="toggle-password" onclick="togglePassword('confirm-password')">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <div class="form-options">
                <label class="terms">
                    <input type="checkbox" name="terms" required> I agree to the <a href="#">Terms</a> and <a href="#">Privacy Policy</a>
                </label>
            </div>
            
            <button name="signupbutton" type="submit" class="auth-btn">Sign Up</button>
        </form>
        
        <div class="auth-footer">
            <p>Already have an account? <a href="login.html">Login</a></p>
            <div class="social-login">
                <p>Or sign up with:</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>

