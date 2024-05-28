<?php
$db = mysqli_connect('localhost', 'Unathi', 'myPassUnathi', 'register');

function Head($name): void
{
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, 
				initial-scale=1.0">
        <title>ADMIN | NANNY CO</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../responsive.css">
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    </head>

    <body>

        <!-- for header part -->
        <header>

            <div class="logosec">
                <div class="logo">NANNY CO</div>
                <img src="" class="icn menuicn" id="menuicn">
            </div>

            <div class="searchbar">
                <input type="text" placeholder="Search">
                <div class="searchbtn">
                    <box-icon name='search'></box-icon>
                </div>
            </div>

            <div class="message">
                <div class="circle"></div>
                <div class="dp">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp">
                </div>
            </div>

        </header>

        <div class="main-container">
            <?php include_once "./sideBar.php";
            sideBar($name);
            ?>
            <div class="main">

                <div class="searchbar2">
                    <input type="text" name="" id="" placeholder="Search">
                    <div class="searchbtn">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png" class="icn srchicn" alt="search-button">
                    </div>
                </div>

            <?php }
