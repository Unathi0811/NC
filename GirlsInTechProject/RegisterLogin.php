<?php

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <title>Register | Login | Nanny Co.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="/logo.png" type="image/x-icon">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(/images/pexels-lum3n-44775-168803.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            color: #4f1271;
            backdrop-filter: blur(6px);
        }

        .container {
            width: 50%;
            padding: 40px;
            border: 8px solid linear-gradient(to bottom, #f0f0f0, #fff);
            height: 100vh;
        }

        .container .form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 25px;
            width: 50%;
            height: 100%;
        }

        /*im trying to make two equal columns*/
        .row {
            display: flex;
            content: "";
            clear: both;
        }

        .column {
            float: left;
            width: 100%;
            height: 545px;
            margin-bottom: 0;
        }

        button {
            background-color: #9c6db0;
            color: white;
            width: 60%;
            padding: 12px;
            border-radius: 23px;
            margin-right: 62px;
            border-color: #9c6db0;
            margin-left: 3px;
            backdrop-filter: blur(4px);
            opacity: 0.75;
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 8px 6px -6px black;
            animation: pulse 2s infinite;
        }

        a {
            text-decoration: none;
            color: #fff;
        }

        .rightSide img {
            top: 0;
            margin-left: 84px;
            width: 70%;
            height: 90vh;
            object-fit: cover;
            z-index: -1;
            backdrop-filter: blur(4px);
            opacity: 0.75;
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 8px 6px -6px black;
            animation: pulse 6s infinite;
        }

        .btn-submit {
            width: 235PX;
            margin-right: 13px;
        }

        @media only screen and (max-width: 768px) {

            /* Adjust the layout for smaller screens */
            body {
                flex-direction: column;
            }

            .container {
                width: 100%;
                padding: 20px;
                border: none;
                height: auto;
            }

            .row {
                flex-direction: column;
            }

            .column {
                width: 100%;
                height: auto;
                margin-bottom: 20px;
            }

            .rightSide {
                width: 100%;
                height: auto;
                padding: 20px;
            }

            .form-container {
                width: 100%;
                height: auto;
                padding: 20px;
            }

            button {
                width: 100%;
                margin-right: 0;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 8px 6px -6px black;
            }

            50% {
                transform: scale(1.1);
                box-shadow: 0 15px 12px -12px rgba(71, 68, 68, 0.3);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 8px 6px -6px black;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column">
                <h2 style="color: purple;">REGISTER AS NANNY</h2>
                <form class="form-container" style=" align-items: center; width: 55%; height: 75%;">
                    <button class="btn-submit" type="submit"><a href="nannyRegistration/nannyRegistration.html">GET STARTED</a></button>
                </form>
            </div>

            <div class="column">
                <h2 style="color: purple;">REGISTER AS A PARENT</h2>
                <form class="form-container" style=" align-items: center; width: 75%; height: 75%;">
                    <button class="btn-submit" type="submit"> <a href="parentRegistration/parentRegistration.html">GET STARTED </a></button>
                </form>
            </div>
        </div>
    </div>
    <script>
    </script>
</body>
</html>