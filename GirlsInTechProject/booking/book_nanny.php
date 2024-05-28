<?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Initialize variables and check if POST keys exist
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $nanny_id = isset($_POST['nanny_id']) ? $_POST['nanny_id'] : '';
        $booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : '';
        $children = isset($_POST['children']) ? $_POST['children'] : '';
        $active = isset($_POST['active']) ? $_POST['active'] : '';

        // Validate and sanitize input (not shown here for brevity)

        // Database connection
        $conn = new mysqli('localhost', 'Unathi', 'myPassUnathi', 'register');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert booking into database using prepared statement
        $stmt = $conn->prepare("INSERT INTO bookings VALUES (?, ?, ?, ?, ?)");  
        $stmt->bind_param("issss", $id, $nanny_id, $booking_date, $children, $active);

        if ($stmt->execute()) {
            echo "Booking successful!";

            // Update nanny availability using prepared statement
            $update_stmt = $conn->prepare("UPDATE nannies SET available = false WHERE id = ?");
            $update_stmt->bind_param("i", $nanny_id);
            if ($update_stmt->execute() !== TRUE) {
                echo "Error updating nanny availability: " . $conn->error;
            }
            $update_stmt->close();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
