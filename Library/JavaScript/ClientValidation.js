var email = document.getElementById("email");
            var userName = document.getElementById("username");
            var lastname = document.getElementById("lastname");
            var password = document.getElementById("password");
            var confirmPassword = document.getElementById("confirmPassword");

            function emptyEmail() {
                if (email.value == "") {
                    return false;
                }
                return true;
            }
            function passwordMatch() {
                if (password.value !== confirmPassword.value) {
                    return false;
                }
                return true;
            }
            function validEmailFormat() {
                var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                if (!(email.value.match(validRegex))) {
                    return false;
                }
                return true;
            }
            function emptyLastname() {
                if (lastname.value == "") {
                    return false;
                }
                return true;
            }
            function emptyUserName() {
                if (userName.value == "") {
                    return false;
                }
                return true;
            }
            function emptyPassword() {
                if (password.value == "") {
                    return false;
                }
                return true;
            }
            function emptyConfirmPassword() {
                if (confirmPassword.value == "") {
                    return false;
                }
                return true;
            }
            function validate() {
                var f = false;
                if (validEmailFormat() == false) {
                    alert("Wrong email format");
                }
                if (passwordMatch() == false) {
                    alert("Passwords do not match");
                }
                if (emptyEmail() == f || emptyLastname() == f || emptyPassword == f || emptyPassword() == f || emptyConfirmPassword == f) {
                    alert("All fields are required!");
                }
            }