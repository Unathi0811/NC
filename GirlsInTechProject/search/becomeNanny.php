<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'Unathi', 'myPassUnathi', 'register');

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Get all available nanny jobs
$sql = "SELECT * FROM nanny_jobs WHERE status = 'available'";
$result = mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NANNY CO | BECOME A NANNY</title>
    <link rel="shortcut icon" href="/logo.png" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
       .container.body-content {
            padding: 8px 0;
            width: 90%;
            margin: 0 auto;
        }

        label,
        input,
        button {
            display: block;
        }

        input[type="text"] {
            padding: 10px;
            width: 100%;
        }

        button {
            margin: 10px 0!important;
            padding: 10px 20px;
        }

        #error-msg {
            color: #C50707;
        }

        /*Map Styling*/
        #map-canvas {
            border: groove 3px #ccc;
            height: 350px;
        }

       .open-me {
            display: none;
        }

        body{
            background-color: rgb(194, 105, 194);

        }


    </style>
</head>

<body>


    <div class="container body-content">
        <h1>Become a Nanny</h1>
        <p>Find available nanny jobs around you.</p>
        <form action="locatenanny.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label for="address">Your Address</label>
                    <input id="address" type="text" name="address" value="City Hall, New York, NY" required>
                </div>
                <div class="col-md-6">
                    <button type="submit">Find Jobs</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCEx9EKv8MkEaFw9KS0JiE9QvED9cGhkJo&amp;callback=initMap"
        async="" defer=""></script>

    <script src="/script.js"></script>
</body>

</html>