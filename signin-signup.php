<?php

include 'dbconn.php';

session_start();

error_reporting(0);

if(isset($_SESSION["user_fullName"])){
  header("Location: home.php");
}

if (isset($_POST["signup"])){
    $fullname = mysqli_real_escape_string($conn, $_POST["signup_fullname"]);
    $username = mysqli_real_escape_string($conn, $_POST["signup_username"]);
    $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
    $password = mysqli_real_escape_string($conn, ($_POST["signup_password"]));
    $cpassword = mysqli_real_escape_string($conn, ($_POST["signup_cpassword"]));

    $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));
    $check_username = mysqli_num_rows(mysqli_query($conn, "SELECT userName FROM users WHERE userName='$username'"));

    $uppercase=preg_match('@[A-Z]@',$password);
    $lowercase=preg_match('@[a-z]@',$password);
    $number=preg_match('@[0-9]@',$password);
    $specialchars=preg_match('@[^\w]@',$password);


    if($password !== $cpassword) {
        echo "<script>alert('Password did not match.');</script>";
    }
        elseif($check_email  > 0){
            echo "<script>alert('Email already exists.');</script>";
        }
        elseif($check_username  > 0){
          echo "<script>alert('Username already exists. Try a different one.');</script>";
      }
        elseif(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password)<8){
          echo "<script>alert('Password should be at least 8 characters in length and should include at least one uppercase letter, one number,and one special character.');</script>";
      }
        else {
            $sql="INSERT INTO users (`fullName`,`userName`, `email`, `password`) VALUES ('$fullname','$username','$email','$password');";
            $result = mysqli_query($conn, $sql);

            if($result) {
                $_POST["signup_fullname"] = "";
                $_POST["signup_username"] = "";
                $_POST["signup_email"] = "";
                $_POST["signup_password"] = "";
                $_POST["signup_cpassword"] = "";
                echo "<script>alert('User Registration Successfully.');</script>";
            }
            else {
                echo "<script>alert('User Registration Failed.');</script>";
            }
        }
    }


    if (isset($_POST["signin"])){        
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, ($_POST["password"]));
        
    
        $check_email = mysqli_query($conn, "SELECT userName FROM users WHERE email='$email' AND password='$password'");
        
        if (mysqli_num_rows($check_email) > 0){
          $row = mysqli_fetch_assoc($check_email);
          $_SESSION["user_userName"]=$row['userName'];
          header("Location: home.php");
        }
        else{
          echo "<script>alert('Login detail is incorrect. Please try again.');</script>";
        }
                        
        }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="POST"class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" value="<?php echo $_POST['email'];?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password'];?>" required/>
            </div>
            <input type="submit" value="Login" name="signin" class="btn solid" />            
          </form>
          <form action="" class="sign-up-form" method="POST">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Full Name" name="signup_fullname" value="<?php echo $_POST["signup_fullname"];?>" required/>
            </div> 
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="User Name" name="signup_username" value="<?php echo $_POST["signup_username"];?>" required/>
            </div>           
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="signup_email" value="<?php echo $_POST["signup_email"];?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="signup_password" value="<?php echo $_POST["signup_password"];?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="signup_cpassword" value="<?php echo $_POST["signup_cpassword"];?>" required/>
            </div>
            <input type="submit" class="btn" name="signup" value="Sign up" />            
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Welcome to Nana Digital
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Step into the new future
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/login.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>