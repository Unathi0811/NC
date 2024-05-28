<?php include('app_logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>LOGIN | NANNY CO</title>
        <link rel="stylesheet" href="main.css">
        <style>
        .container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 100vh;
        }
        .login-form {
                width: 50%;
                margin-right: 290px;
                align-items: center;
        }
        </style>
</head>
<body>
        <form class="login-form"  method="post">
                <h2 class="login-title" style="color: #4f1271; font-size: 2rem;">Login</h2>
                <p class="notice">Please login to access the system</p>
                <div class="form-group">
                        <label for="user_id">Email</label>
                        <div  class="input-email">
                                <i class="fas fa-envelope icon"></i>  
                                
                                <input type="text" style="border: none; background-color: transparent; font-size: 1rem;" placeholder="Enter your e-mail" name="user_id">

                        </div>
                </div>

                <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-password">
                                <i class="fas fa-lock icon"></i>
                                <input type="password" name="password" placeholder="Enter your password" >
                        </div>
                </div>

                <div class="form-group">
                        <button type="submit" name="login_user" class="login-btn">Login</button>
                </div>

                <a href="RegisterLogin.php" style="text-decoration: none;">Not a member yet?  <span style="color: #4f1271;">register now!</span></a>

                <!--Dont touch this-->
                <p><a href="enter_email.php">Forgot your password?</a></p>
        </form>
</body>
</html>
<?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
                $user=$_POST['user_id'];
                $pass=$_POST['password'];
                
                $connection=mysqli_connect("localhost", "Unathi", "myPassUnathi", "register");
                if(!$connection){
                        die("Database connection failed: " . mysqli_connect_error());
                        
                }
        
                else{
                        $query= "SELECT `name`, `password` from `nannies` where `name`=? AND  `password`=?";
                        $stmt=mysqli_prepare($connection, $query);
                        mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result)==1){
                                header("Location: ../profile/userAccount.php");
                                exit;
                        }

                }
        }



        
?>
