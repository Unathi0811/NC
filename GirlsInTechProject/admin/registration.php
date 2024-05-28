<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect('localhost', 'Unathi', 'myPassUnathi', 'register');
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare SQL query to insert a new admin
        $sql = "INSERT INTO `admins` (`username`, `password`, `email`) VALUES (?, ?, ?)";
        $statement = mysqli_prepare($conn, $sql);
        
        // Bind the parameters
        mysqli_stmt_bind_param($statement, "sss", $username, $hashed_password, $email);
        
        // Execute the statement
        if (mysqli_stmt_execute($statement)) {
            echo "Admin registered successfully!";
        } else {
            echo "Error: " . mysqli_stmt_error($statement);
        }

        // Close the statement and connection
        mysqli_stmt_close($statement);
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="submit" value="Register">
    </form>
</body>
</html>
