<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
</head>
<body>
    <h1 style="color: purple; font-size: 2rem;">My Bookings</h1>
    <?php
    // Database connection
    $conn = new mysqli('localhost', 'Unathi', 'myPassUnathi', 'register');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch bookings for the parent
    $id= "";  // Replace with the actual parent name 
    $sql = "SELECT b.id, b.nanny_id, b.booking_date, n.children, n.active as nanny_id
            FROM bookings b
            INNER JOIN nannies n ON b.nanny_id = n.id
            WHERE b.id = '$id'
            ORDER BY b.booking_date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Booking ID</th><th>Nanny Name</th><th>Booking Date</th><th>Children</th><th>Active</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nanny_id"] . "</td>";
            echo "<td>" . $row["booking_time"] . "</td>";
            echo "<td>" . $row["children"] . "</td>";
            echo "<td>" . $row["active"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No bookings found.";
    }

    $conn->close();
    ?>

    <p style="width: 266px;
            padding: 12px;
            border-radius: 30px;
            border: 2px solid purple;"><a href="payment.html">Proceed To Payment</a></p>

    <p style="width: 266px;
            padding: 12px;
            border-radius: 30px;
            border: 2px solid purple;"><a href="booking.html">Back To Booking Page</a></p>
</body>
</html>
