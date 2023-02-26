<?php
require "../../Database/Connection.php";
require "../../Class/UserClass.php";
session_start();
require("ServerValidation.php");
$email = "";
$name = "";
$register = new User();

if (isset($_POST['signUp'])) {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    if (emailValidation($email) == false) {
        echo ("<span id='emailSpan' style='color:red';>wrong email fromat!</span><br>");
    } elseif (emptyFieldsValidation($name, $lastname, $email, $password, $confirmPassword) == false) {
        echo ("<span style='color:red';> all fields are required!</span><br>");
    } elseif (equlePasswords($password, $confirmPassword) == false) {
        echo ("<span style='color:red';> passwords do not match!</span><br>");
    } else {
        $register->createUser($conn, $name, $email, $password, $lastname);
    }

}



?>