<?php
$id;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"])) {
        header("Location: ../admin.php");
        exit;
    }

    $id = $_GET["id"];
    $db = mysqli_connect('localhost', 'Unathi', 'myPassUnathi', 'register');

    $sql = "UPDATE `users_profile` SET `verified`= 1 WHERE `id` = $id";

    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if ($result) {
        header("Location: ../admin/?message=Nanny verified successfully");
    } else {
        header("Location: ../admin/?message=SOMETHING WENT WRONG");
    }
}
