<?php include('app_logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>Password Reset PHP</title>
        <link rel="stylesheet" href="main.css">
        <style>
                body{
                        background-color: plum;
                }
        </style>
</head>
<body>
        <form class="login-form" action="enter_email.php" method="post">
                <h2 class="form-title">Reset password</h2>
                <!-- form validation messages -->
                <?php include('messages.php'); ?>
                <div class="form-group">
                        <label>Your email address</label>
                        <input style="border: 3px solid black; border-radius: 20px;" type="email" name="email">
                </div>
                <div class="form-group">
                        <button type="submit" name="reset-password" class="login-btn">Submit</button>
                </div>
        </form>
</body>
</html>