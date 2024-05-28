<?php
    $servername = "localhost";
    $username = "Unathi";
    $password = "myPassUnathi";
    $dbname = "register";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO payments (fname, email, address, town, province, postal, payment_method, cardnumber, expirydate, expiryyear, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssssssss", $fname, $email, $address, $town, $province, $postal, $payment_method, $cardnumber, $expirydate, $expiryyear, $cvv);

    // Set parameters and execute
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $town = $_POST['town'];
    $province = $_POST['province'];
    $postal = $_POST['postal'];
    $payment_method = $_POST['payment_method'];
    $cardnumber = $_POST['cardnumber'];
    $expirydate = $_POST['expirydate'];
    $expiryyear = $_POST['expiryyear'];
    $cvv = $_POST['cvv'];

    if ($stmt->execute()) {
        // Redirect to confirmation page upon successful submission
        header("Location: confirmation.html");
        exit();
    } else {
        // If insertion fails, display error message
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
?>
