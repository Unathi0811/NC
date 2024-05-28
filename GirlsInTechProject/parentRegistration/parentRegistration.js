
    document.addEventListener('DOMContentLoaded', function () {
        // Checkbox alert
        const checkBox = document.querySelector('input[type="checkbox"]');
        checkBox.addEventListener('change', function () {
            if (checkBox.checked) {
                alert('By checking this box, you confirm that you have read and understood the terms and conditions and the privacy policy.');
            }
        });

        // Profile picture upload
        function upload() {
            const fileUploadInput = document.querySelector('.file-uploader');
            const file = fileUploadInput.files[0];
            if (!file.type.includes('image')) {
                alert('Only images are allowed!');
                return;
            }

            if (file.size > 10_000_000) {
                alert("Maximum upload size is 10MB!");
                return;
            }

            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.onload = (fileReaderEvent) => {
                const displayPicture = document.querySelector('.profilePicture img'); // Ensure you have an img tag to display the picture
                displayPicture.src = fileReaderEvent.target.result;
            };
        }

        const fileUploadInput = document.querySelector('.file-uploader');
        fileUploadInput.addEventListener('change', upload);

        // Form validation
        const form = document.querySelector('#registrationForm');
        const usernameEls = document.querySelectorAll('#username input'); // Adjusted to select all username inputs
        const emailEl = document.querySelector('#email input');
        const passwordEl = document.querySelector('#password');
        const confirmPasswordEl = document.querySelector('#confirm-password');

        const checkUsername = () => {
            let valid = false;
            const min = 3, max = 25;
            const usernames = Array.from(usernameEls).map(input => input.value.trim());

            for (let username of usernames) {
                if (!isRequired(username)) {
                    showError(usernameEls[0], 'Username cannot be blank.');
                    return false;
                } else if (!isBetween(username.length, min, max)) {
                    showError(usernameEls[0], `Username must be between ${min} and ${max} characters.`);
                    return false;
                } else {
                    showSuccess(usernameEls[0]);
                    valid = true;
                }
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
            const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
            return re.test(password);
        };

        const isRequired = value => value === '' ? false : true;
        const isBetween = (length, min, max) => length < min || length > max ? false : true;

        const showError = (input, message) => {
            const formField = input.parentElement;
            formField.classList.remove('success');
            formField.classList.add('error');
            const error = formField.querySelector('small');
            if (error) {
                error.textContent = message;
            }
        };

        const showSuccess = (input) => {
            const formField = input.parentElement;
            formField.classList.remove('error');
            formField.classList.add('success');
            const error = formField.querySelector('small');
            if (error) {
                error.textContent = '';
            }
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

            if (isFormValid) {
                form.submit();
            }
        });

        passwordEl.addEventListener('input', checkConfirmPassword);
    });
