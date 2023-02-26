<?php
function emailValidation($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}
function emptyFieldsValidation($name, $lastname, $email, $password, $confirmPassword)
{
    if (empty($name) || empty($lastname) || empty($password) || empty($confirmPassword)) {
        return false;
    }
    return true;
}
function equlePasswords($password, $confirmPassword)
{
    if ($password !== $confirmPassword) {
        return false;
    }
    return true;
}
?>