<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>

<body>
    <h1>Booking Confirmation</h1>
    <?php
    // Display booking details
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $parent_name = $_POST['id'];
        $nanny_id = $_POST['nanny_id'];
        $booking_date = $_POST['booking_date'];
        $children = $_POST['children'];
        $active = $_POST['active'];

        // Database connection
        $conn = new mysqli('localhost', 'Unathi', 'myPassUnathi', 'register');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get nanny name
        $nanny_name = "";
        $nanny_sql = "SELECT name FROM nannies WHERE id = $nanny_id";
        $result = $conn->query($nanny_sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nanny_name = $row['name'];
        }

        // Insert booking into database
        $sql = "INSERT INTO bookings (id, nanny_id, booking_date, children, active)
        VALUES ('$id', '$nanny_id', '$booking_date', '$children', '$active')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<p>Your booking has been confirmed:</p>";
            echo "<p>id: $id</p>";
            echo "<p>nanny_id: $nanny_id</p>";
            echo "<p>Booking_date: $booking_date</p>";
            echo "<p>Children: $children</p>";
            echo "<p>Active: $active</p>";

            // You can provide a link to view all bookings or go back to booking page
            echo "<p><a href='/payment.html'>Proceed to payment</a></p>";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>

</html>