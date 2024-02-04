<?php
   session_start();

   include("db.php");

   if($_SERVER['REQUEST_METHOD']=="POST")
   {
     $name=$_POST['name'];
     $user_name = $_POST['user'];   
     $email = $_POST['email'];
     $password =$_POST['pass'] ;
          

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script type='text/javascript'>alert('Enter a valid email address')</script>";
    } 
    else {
        
        if (preg_match("/^[a-zA-Z0-9_]+$/", $user_name)) {
            
            $query_check_username = "SELECT user FROM form WHERE user = '$user_name'";
            $result = mysqli_query($con, $query_check_username);

            if (mysqli_num_rows($result) == 0) {
                
                if (strlen($password) >= 8 && preg_match("/[A-Z]+/", $password) && preg_match("/[a-z]+/", $password) && preg_match("/[0-9]+/", $password)) {
                    

                    
                    $query = "INSERT INTO form (name, user, email, pass) VALUES ('$name', '$user_name', '$email', '$password')";
                    mysqli_query($con, $query);

                    echo "<script type='text/javascript'>alert('Successfully Registered')</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Password should be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one digit.')</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Username is already taken. Choose a different username.')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Username can only contain letters, numbers, and underscores')</script>";
        }
    }
}


   






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration </title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/c9c2fd6372.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class = "form">
        <div class="form-box">
            <div class="button-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()">Login</button>
                    <button type="button" class="toggle-btn" onClick="register()">Register</button>

                </div>
                <form id="login"class="input-group" method="post" action="login-regs.php">
                    
                <i class="fa-solid fa-user"></i> <label>Enter Username</label>
                <input type="text" name="user" class="input-field"  required>
                <i class="fa-solid fa-lock"></i> <label>Enter Password</label>
                <input type="password" name="pass" class="input-field"  required>
                    <div class="sub-btn">
                    <button type="submit" class="submit-btn">Login</button> 
                    <br /> <br /> 
                    <a href="forgot-password.php">Forgot Password?</a>
  
                    </div>
                </form>
                <form id="register" class="input-group" method="post">
                <i class="fa-solid fa-user-tie"></i> <label>Enter Full Name</label>
                <input type="text" name="name" class="input-field"  required>
                <i class="fa-solid fa-user"></i> <label>Enter Username</label>
                <input type="text" name="user" class="input-field"required>
                <i class="fa-solid fa-envelope"></i> <label>Enter Email</label>
                <input type="text" name="email" class="input-field"  required>
                    <i class="fa-solid fa-lock"></i> <label>Enter Password</label>
                    <input type="password" name="pass" class="input-field" required>
                    <div class="sub-btn">
                    <button type="submit" class="submit-btn">Register</button>
                </div>
                 

            </div>
        </div>
    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register(){
            x.style.left = "-400px";
            y.style.left = "18px";
            z.style.left="110px";
        }

        
        function login(){
            x.style.left = "10px";
            y.style.left = "500px";
            z.style.left="0px";
        }
    </script>
    
</body>
</html>