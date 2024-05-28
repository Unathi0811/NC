<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect('localhost', 'Unathi', 'myPassUnathi', 'register');
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!$conn) {
        die("Database connection failed: ". mysqli_connect_error());
    } else {
        $sql = "SELECT `username`, `password` FROM `admins` WHERE `username` =?";
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                header("Location: index.php");
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "Username not found.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form action="login.php" method="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <a href="index.php">Submit</a>
    </form>
</body>

</html>