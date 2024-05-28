<?php
    $servername = "localhost";
    $username = "Unathi";
    $password = "myPassUnathi";
    $dbname = "register";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Ensure the uploads directory exists
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are set
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['language']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            // Retrieve form data
            $name = $_POST['name'];
            $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
            $email = $_POST['email'];
            $phone = $_POST['phone']; 
            $Ethnicity = isset($_POST['Ethnicity']) ? $_POST['Ethnicity'] : '';
            $language = $_POST['language'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $Resume = isset($_FILES['Resume']['name']) ? $_FILES['Resume']['name'] : '';
            $Certificate = isset($_FILES['Certificate']['name']) ? $_FILES['Certificate']['name'] : '';
        }

            // Compare passwords before hashing
            if ($password !== $confirm_password) {
                die("Passwords do not match.");
            }

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Move uploaded files to target directory
            $resumeUploaded = false;
            $certificateUploaded = false;
            $errors = [];

            if (isset($_FILES['Resume']) && $_FILES['Resume']['error'] === UPLOAD_ERR_OK) {
                $resumeTmpPath = $_FILES['Resume']['tmp_name'];
                $resumeName = basename($_FILES['Resume']['name']);
                $resumeDestPath = $target_dir . $resumeName;
                if (move_uploaded_file($resumeTmpPath, $resumeDestPath)) {
                    $resumeUploaded = true;
                } else {
                    $errors[] = "There was an error uploading your resume.";
                }
            }

            if (isset($_FILES['Certificate']) && $_FILES['Certificate']['error'] === UPLOAD_ERR_OK) {
                $certificateTmpPath = $_FILES['Certificate']['tmp_name'];
                $certificateName = basename($_FILES['Certificate']['name']);
                $certificateDestPath = $target_dir . $certificateName;
                if (move_uploaded_file($certificateTmpPath, $certificateDestPath)) {
                    $certificateUploaded = true;
                } else {
                    $errors[] = "There was an error uploading your certificate.";
                }
            }

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                die();
            }

            // Insert data into the database
            $sql = $conn->prepare("INSERT INTO users_profile (name, surname, email, phone, Ethnicity, language, password, resume, certificate)VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $sql->bind_param("sssssssss", $name, $surname, $email, $phone, $Ethnicity, $language, $hashed_password, $Resume, $Certificate);

            if ($sql->execute()) {
                
            } else {
                if ($conn->errno == 1062) {
                    die("Error inserting record: Duplicate entry for key 'PRIMARY'.");
                } else {
                    die("Error inserting record: " . $conn->error);
                }
            }
        } else {
            die("Please fill in all required fields.");
        }


    // Close database connection
    mysqli_close($conn);
    // include("viewprofile.html");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register | NANNIES | Nanny Co.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/stylesheet.css">
    <link rel="shortcut icon" href="/logo.png" type="image/x-icon">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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
            padding: 40px;
            width: 85%;
            height: 50%;
            left: 0;
        }

        .container .form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 25px;
            width: 100%;
        }

        .container .form.signin,
        .container.signinForm .form.signup {
            display: none;
        }

        .container.signinForm .form.signin {
            display: flex;
        }

        .container .form h2 {
            color: #4f1271;
            font-weight: 500;
            letter-spacing: 0.1em;
        }

        .container .form .inputBox {
            position: relative;
            width: 300px;
        }

        .container .form .inputBox input {
            padding: 12px 10px 12px 48px;
            border: none;
            width: 100%;
            background-color: white;
            color: #4f1271;
            font-weight: 300;
            border-radius: 25px;
            font-size: 1em;
            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                5px 5px 15px rgba(0, 0, 0, 0.35);
            transition: 0.5s;
            background-color: white;
            outline: none;
        }

        .container .form .inputBox span {
            position: absolute;
            left: 0;
            padding: 12px 10px 12px 48px;
            pointer-events: none;
            font-size: 1em;
            font-weight: 300;
            transition: 0.5s;
            letter-spacing: 0.05em;
            color: #4f1271;
        }

        .container .form .inputBox input:valid~span,
        .container .form .inputBox input:focus~span {
            color: #4f1271;
            border: 1px solid 4f1271;
            background: white;
            transform: translateX(25px) translateY(-7px);
            font-size: 0.6em;
            padding: 0 8px;
            border-radius: 10px;
            letter-spacing: 0.1em;
        }

        .container .form .inputBox input:valid,
        .container .form .inputBox input:focus {
            border: 1px solid 4f1271;
        }

        .container .form .inputBox i {
            position: absolute;
            top: 15px;
            left: 16px;
            width: 25px;
            padding: 2px 0;
            padding-right: 8px;
            color: 4f1271;
            border-right: 1px solid #4f1271;
        }

        .container .form .inputBox input[type="submit"] {
            background: #4f1271;
            color: black;
            padding: 10px 0;
            font-weight: 500;
            cursor: pointer;
            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                5px 5px 15px rgba(0, 0, 0, 0.35),
                inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                inset 5px 5px 15px rgba(0, 0, 0, 0.35);
        }

        .container .form p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75em;
            font-weight: 300;
        }

        .container .form p a {
            font-weight: 500;
            color: #fff;
        }

        #passwordStrength {
            color: #4f1271;
        }

        #nannyCHKB {
            color: #4f1271;
        }

        /*profile picture*/
        #profilePicture {
            opacity: 0.75;
            height: 90px;
            width: 90px;
            position: relative;
            overflow: hidden;
            background: url('https://qph.cf2.quoracdn.net/main-qimg-f32f85d21d59a5540948c3bfbce52e68');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 8px 6px -6px black;
        }

        .file-uploader {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
            top: 0%;
            left: 0%;
        }

        .upload-icon {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            color: #ccc;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: #bbb;
        }

        #profilePicture:hover .upload-icon {
            opacity: 1;
        }

        /**/
        .row::after {
            display: table;
            content: "";
            clear: both;
        }

        .inputBox {
            float: left;
            width: 50%;
        }

        .agreeTermsAndConditions label li {
            text-decoration: none;
            list-style: none;
            display: inline;
        }

        input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 20px;
            height: 20px;
            background-color: transparent;
            border-radius: 3px solid black;
            outline: none;
            cursor: pointer;
            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                5px 5px 15px rgba(0, 0, 0, 0.35),
                inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                inset 5px 5px 15px rgba(0, 0, 0, 0.35);
        }

        input[type="checkbox"]:checked {
            background-color: #4f1271;
        }

        input[type="checkbox"]::before {
            content: '\2713';
            display: inline-block;
            font-size: 20px;
            color: black;
            line-height: 20px;
            text-align: center;
            visibility: hidden;
        }

        input[type="checkbox"]:checked::before {
            visibility: visible;
        }

        .dropBtn {
            cursor: pointer;
            background-color: transparent;
            border-radius: 30px;
            border: 2px solid #4f1271;
            width: 170px;
            padding: 10px 10px 12px 48px;
            pointer-events: none;
            font-size: 1em;
            font-weight: 300;
            transition: 0.5s;
            letter-spacing: 0.05em;
            color: #4f1271;
        }

        .dropBtn:hover,
        .dropBtn:focus {
            background-color: #4f1271;
        }

        #dropdown {
            position: relative;
            display: inline-block;
        }

        #dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px #4f1271;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: none;
        }

        .dropdown-content a:hover {
            background-color: #4f1271;
        }

        .show {
            display: block;
        }

        .hourlyRate {
            margin-left: 67px;
        }

        .hourlyRate label {
            margin-left: 67px;
        }

        .hourlyRate input {
            border: 1px solid #4f1271;
            background: white;
            font-size: 1em;
            padding: 5px 8px;
            border-radius: 10px;
            color: #4f1271;
            width: 200px;
            margin-left: 12px;
        }

        .hourlyRate input:hover {
            color: #4f1271;
        }

        /*aploading documents */
        .row22::after {
            display: table;
            content: "";
            clear: both;
        }

        .row22 {
            column-gap: 62px;
        }

        .column22 {
            float: left;
        }

        .column22 button {
            background-color: transparent;
            border-radius: 30px;
            border: none;
            width: 170px;
            margin-left: 12px;
            margin-top: 13%;
            padding: 10px 10px 12px 48px;
            pointer-events: none;
            font-size: 1em;
            font-weight: 300;
            transition: 0.5s;
            letter-spacing: 0.05em;
            color: #4f1271;
        }

        /*passwords*/
        .row23::after {
            display: table;
            content: "";
            clear: both;
        }

        #column23 {
            float: left;
            width: 320px;
        }

        .rightSide img {
            top: 0;
            width: 345px;
            height: 444px;
            margin-bottom: 0;
            margin-right: 45px;
            object-fit: cover;
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

        .submit{
            background-color: #4f1271;
            border-radius: 30px;
            border: 2px solid #4f1271;
            width: 170px;
            margin-left: 199px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="registrationForm" class="form signup">
            <h2 style="margin-right: 178px; font-size: 1.6rem; font-weight: bold;">CREATE ACCOUNT (NANNY) </h2>
            <form action="nannyRegistration.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="inputBox" id="username">
                        <input type="text" name="name" required="required">
                        <i class="fa-regular fa-user"></i>
                        <span>first name</span>
                    </div>
                    <div class="inputBox" name="surname" id="username">
                        <input type="text" name="surname" required>
                        <i class="fa-regular fa-user"></i>
                        <span>last name</span>
                    </div>
                </div>
                <br> 
                <div class="row">
                    <div class="inputBox" id="username">
                        <input type="text" name="phone" required="required">
                        <i class="fa-solid fa-phone"></i>
                        <span>Phone</span>
                    </div>

                    <div class="inputBox" id="email">
                        <input type="text" name="email" required="required">
                        <i class="fa-regular fa-envelope"></i>
                        <span>email address</span>
                    </div>
                </div>
                <br>
                <div id="documentsApload" class="row22">
                    <div id="profilePicture" class="column22">
                        <!--<label for="pp" style="color: #4f1271; text-align: center;">Profile Picture</label> <br> -->
                        <h1 class="upload-icon">
                            <i class="fa fa-plus fa-2x"></i>
                        </h1>
                        <input type="file" class="file-uploader" accept="image/*" required="required">
                    </div>

                    <div class="column22">
                        <label for="Resume" style="color: #4f1271; margin-left: 53px">Resume</label>
                        <input style="background-color: #a08aac; color: #a08aac" type="file" id="experience_file" name="Resume">
                    </div>
                    <br> <br>
                    <div class="column22">
                        <label for="Certificate" style="color: #4f1271; margin-left:53px">Certificate</label>
                        <input style="background-color: #a08aac; margin-right:123px" type="file" id="qualifications_file" name="Certificate">
                    </div>
                </div>

                <div class="row22">
                    <div class="column22">
                        <button class="dropBtn" onclick="myFunction()">Language</button>
                        <select style="background-color: #a08aac;" name="language" class="language">
                            <option value="english">English</option>
                            <option value="zulu">IsiZulu</option>
                            <option value="xhosa">Xhosa</option>
                            <option value="sepedi">Sepedi</option>
                            <option value="sesotho">Sesotho</option>
                            <option value="ndebele">IsiNdebele</option>
                            <option value="afrikaans">Afrikaans</option>
                            <option value="tsonga">Xitsonga</option>
                        </select>
                    </div>

                    <div class="column22">
                        <button class="dropBtn" onclick="myFunction()">Ethnicity</button>
                        <select style="background-color: #a08aac;" id="ethnicity" name="ethnicity">
                            <option value="african">African</option>
                            <option value="coloured">Coloured</option>
                            <option value="indian">Indian</option>
                            <option value="white">White</option>
                            <option value="asian">Asian</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <br> 

                <div class="hourlyRate" style=" margin-right: 153px">
                    <label for="hourlyRate" style="color: #4f1271; text-align: center; margin-left: 199px">Hourly Rate:</label> <br>
                    <input type="number" name="hourlyRate" id="hourlyRate" style="color: #4f1271; text-align: center; margin-left: 149px">
                </div>
                <br>

                <div class="row">
                    <div class="inputBox" id="column23" style="margin-left: 13px;">
                        <input type="password" id="password" name="password" required="required">
                        <i class="fa-solid fa-lock"></i>
                        <span>create password</span>
                    </div>

                    <div class="inputBox" id="column23"  style="margin-right: 13px;">
                        <input type="password" id="confirm-password" name="confirm_password" required="required">
                        <i class="fa-solid fa-lock"></i>
                        <span>confirm password</span>
                    </div>
                </div>

                <br>

                <div class="agreeTermsAndConditions"  style="margin-left: 22px;">
                    <label>
                        <input type="checkbox" style="color: #4f1271;">
                        I accept the <a href="/termsOfService.html">Terms And Conditions </a>and <a
                            href="/privacyPolicy.html">Privacy Policy</a>
                    </label>
                </div>

                <br>

                <div class="checkbox-group" style="margin-left: 22px;">
                    <input type="checkbox" id="nanny" name="service_areas[]" value="nanny">
                    <label for="nanny">Nanny</label>

                    <input type="checkbox" id="nurse" name="service_areas[]" value="nurse">
                    <label for="nurse">Nurse</label>

                    <input type="checkbox" id="caregiver" name="service_areas[]" value="caregiver">
                    <label for="caregiver">Caregiver</label>

                    <input type="checkbox" id="babysitter" name="service_areas[]" value="babysitter">
                    <label for="babysitter">Babysitter</label>
                </div>
                <br>

                <div id="inputBox" style="margin-left: 22px;">
                    <input class="submit" style="color: white" type="submit" value="GET STARTED">
                </div>
            </form>
            <p style="font-size: 1rem; margin-right: 22px; color: black;">Already a member ? <a href="/passwordRecovery/login.php" class="login" style="color: #4f1271;">Log in</a></p>

        </div>
    </div>
    <script>
        //checkbox
        document.addEventListener('DOMContentLoaded', function () {
            const checkBox = document.querySelector('input[type="checkbox"]');

            checkBox.addEventListener('change', function () {
                if (checkBox.checked) {
                    alert('By checking this box, you confirm that you have read and understood the terms and conditions and the privacy policy.');
                }
            });
        });

        //profile picture/ NEEDS A DATABASE THOUGH
        function upload() {
            const fileUploadInput = document.querySelector('.file-uploader');
            const file = fileUploadInput.files[0];
            if (!image.type.includes('image')) {
                alert('Only images are allowed!');
            }

            if (image.size > 10_000_000) {
                return alert("Maximum upload size is 10MB!");
            }

            const fileReader = new FileReader();
            fileReader.readAsDataURL(image);
            fileReader.onload = (fileReaderEvent) => {
                const displayPicture = document.querySelector('.profilePicture');
                displayPicture.src = fileReaderEvent.target.result;
            }
        }

        //dropdown
        function myFunction() {
            document.getElementById("dropdown").classList.toggle("show");
        }

        window.onclick = function (event) {
            if (!event.target.matches('.dropBtn')) {
                var myDropdown = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < myDropdown.length; i++) {
                    var openDropdown = myDropdown[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        //registration form
        document.addEventListener('DOMContentLoaded', () => {
            const login = document.querySelector('.login');
            const create = document.querySelector('.create');
            const container = document.querySelector('.container');

            login.onclick = function () {
                container.classList.add('signinForm');
            };

            create.onclick = function () {
                container.classList.remove('signinForm');
            };
        });

        document.addEventListener('DOMContentLoaded', () => {
            const usernameEl = document.querySelector('#username');
            const emailEl = document.querySelector('#email');
            const passwordEl = document.querySelector('#password');
            const confirmPasswordEl = document.querySelector('#confirm-password');
            const form = document.querySelector('#registrationForm');

            const checkUsername = () => {
                let valid = false;
                const min = 3,
                    max = 25;
                const username = usernameEl.value.trim();

                if (!isRequired(username)) {
                    showError(usernameEl, 'Username cannot be blank.');
                } else if (!isBetween(username.length, min, max)) {
                    showError(usernameEl, "Username must be between ${min} and ${max} characters.");
                } else {
                    showSuccess(usernameEl);
                    valid = true;
                }
                return valid;
            };

            const checkEmail = () => {
                let valid = false;
                const email = emailEl.value.trim();
                if (!isRequired(email)) {
                    showError(emailEl, 'Email cannot be blank.');
                } else if (!isEmailValid(email)) {
                    showError(emailEl, 'Email is not valid.');
                } else {
                    showSuccess(emailEl);
                    valid = true;
                }
                return valid;
            };

            const checkPassword = () => {
                let valid = false;
                const password = passwordEl.value.trim();

                if (!isRequired(password)) {
                    showError(passwordEl, 'Password cannot be blank.');
                } else if (!isPasswordSecure(password)) {
                    showError(passwordEl, 'Password must have at least 8 characters including at least 1 lowercase character, 1 uppercase character, 1 number, and 1 special character in (!@#$%^&*)');
                } else {
                    showSuccess(passwordEl);
                    valid = true;
                }

                return valid;
            };

            const checkConfirmPassword = () => {
                let valid = false;
                const confirmPassword = confirmPasswordEl.value.trim();
                const password = passwordEl.value.trim();

                if (!isRequired(confirmPassword)) {
                    showError(confirmPasswordEl, 'Please enter the password again.');
                } else if (password !== confirmPassword) {
                    showError(confirmPasswordEl, 'The password does not match.');
                } else {
                    showSuccess(confirmPasswordEl);
                    valid = true;
                }

                return valid;
            };

            const isEmailValid = (email) => {
                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            };

            const isPasswordSecure = (password) => {
                const re = new RegExp("^(?=.[a-z])(?=.[A-Z])(?=.[0-9])(?=.[!@#\$%\^&\*])(?=.{8,})");
                return re.test(password);
            };

            const isRequired = value => value === '' ? false : true;
            const isBetween = (length, min, max) => length < min || length > max ? false : true;

            const showError = (input, message) => {
                const formField = input.parentElement;
                formField.classList.remove('success');
                formField.classList.add('error');
                const error = formField.querySelector('small');
                error.textContent = message;
            };

            const showSuccess = (input) => {
                const formField = input.parentElement;
                formField.classList.remove('error');
                formField.classList.add('success');
                const error = formField.querySelector('small');
                error.textContent = '';
            };

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                let isUsernameValid = checkUsername(),
                    isEmailValid = checkEmail(),
                    isPasswordValid = checkPassword(),
                    isConfirmPasswordValid = checkConfirmPassword();

                let isFormValid = isUsernameValid &&
                    isEmailValid &&
                    isPasswordValid &&
                    isConfirmPasswordValid;
            });

            passwordEl.addEventListener('input', checkConfirmPassword);
        });


        function openModal() {
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }
        function confirmAction(isConfirmed) {
            if (isConfirmed) {
                alert("User clicked OK!");
            } else {
                alert("User clicked Cancel!");
            }
            closeModal();
        }

        window.onclick = function (event) {
            var modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Add an event listener to the button
        document.addEventListener('DOMContentLoaded', () => {
            const getStartedBtn = document.getElementById('inputBox');

            // Define the function to be executed when the button is clicked
            getStartedBtn.addEventListener('click', function () {
                // Select the form element and submit it
                const form = document.querySelector('#registrationForm form');
                form.submit();
            });
        });


    </script>
</body>

</html>