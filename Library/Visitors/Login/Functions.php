<?php
$email = "";
require "../../Database/Connection.php";
require "../../Class/LogsClass.php";
if (isset($_POST['submit']) && $_POST['g-recaptcha-response'] != "") {
    $secret = "6Lek9dUjAAAAAP7059JFOERT86V_ss9aiax-PdKt";
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='. $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if ($responseData->success) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        if (checkAttempts($conn, $email) == true) {
            login($conn, $password, $email);
        }else{
            header('location: Login.php?message=You entered to manny tryes!');
        }
    }
}
function checkEmail($conn, $email){
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $checkEmail);
    if (mysqli_num_rows($res) > 0) {
        return true;
    }else{
        header('location: Login.php?message=You are not a member!');
        return false;
    }
}
function checkPassword($conn, $email, $password){
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $checkEmail);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetchPass = $fetch['password'];
        if (password_verify($password, $fetchPass)) {
            return true;  
        }else{
            header('location: Login.php?message=Incorrect password!');
            return false;
        }
    }
}
function isAccountActive($conn, $email){
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $checkEmail);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $code = $fetch['code'];
        if ($code < 0) {
            header('location: Login.php?message=Your account is deactivated!');
            return false;
        }
        elseif($code > 0){
            header('location: Login.php?message=Your account is not active!');
            return false;
        }
        else{
            return true;
        }
        
    }
}


function selectUser($conn, $password, $email){

    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $checkEmail);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $status = $fetch['status'];
        $user = $fetch['user'];
        session_start();
        if ($status == 'verified' && $user == 'admin') {
            $_SESSION['email'] = $email;
            $_SESSION['id'] = 2;
            loginStatistics($conn);
            header('location: ../../Admin/Index.php');
            
        } elseif ($status == 'verified') {
            $_SESSION['email'] = $email;
            $_SESSION['id'] = 1;
            loginStatistics($conn);
            header('location: ../../User/Index.php');
            
        }
    }
}
function login($conn, $password, $email){
    $checkEmail = checkEmail($conn, $email);
    $checkPassword = checkPassword($conn, $email, $password);
    $isAccountActive = isAccountActive($conn, $email);
    $sql = "UPDATE users SET attempts = 0 WHERE email = '$email'";
    $sql2 = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql2);
    if($checkEmail == true && $checkPassword == true && $isAccountActive == true){
  
        selectUser($conn, $password, $email);
        $conn->query($sql);
        //zapisi u bazu login
        
        return true;
    }else{
        if(mysqli_num_rows($result) > 0){
            $fetch2 = mysqli_fetch_assoc($result);
            $attempt = $fetch2['attempts'];
        }
        $attempt++;
        $sql2 = "UPDATE users SET attempts = $attempt WHERE email = '$email'";
        $conn->query($sql2);
        return false;
    }
}
function checkAttempts($conn, $email){
    $sql2 = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $sql2);
    $sql = "SELECT * FROM config";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $fetch2 = mysqli_fetch_assoc($result);
        $providedAttempts = $fetch2['attempts'];
    }
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $attempts = $fetch['attempts'];
        if($attempts < $providedAttempts){

            return true;
        }else{
            return false;
        }
    }
}
function loginStatistics($conn){
    $userEmail = $_SESSION['email'];
    $time = time();
    $loginDate = date('Y-m-d H:i:s', $time);
    $sql = "SELECT * FROM users WHERE email = '$userEmail'";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $userId = $fetch['id'];
    $insertData = "INSERT INTO loginStatistics(userId, loginStamp, loginDate)
                    VALUES($userId, $time, '$loginDate')";
    $check = mysqli_query($conn, $insertData);
    if ($check ) {
        $logs = new Logs();
        $action = "add";
        $tableName = "loginStatistics";
        $logs->createLog($conn, $action, $tableName);
    }
}
?>