<?php
require("LogsClass.php");
class User extends Logs
{
    public function createLog($conn, $action, $tableName, $email = null){
        $time = time();
        $date = date("Y-m-d", $time);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $fetch = mysqli_fetch_assoc($result);
        $userId = $fetch['id'];
        $page = $_SERVER['PHP_SELF'];
        $insertData = "INSERT INTO logs(userId, time, date, action, page, tableName)
                        VALUES($userId, $time, '$date', '$action', '$page', '$tableName')";
        
        mysqli_query($conn, $insertData);
    }
     public function createUser($conn, $name, $email, $password, $lastname)
    {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(111111, 999999);
        $status = "notverified";
        $user = "user";
        $attempts = 0;
        $insertData = "INSERT INTO users (name, lastname, email, password, code, status, user, attempts)
                        values('$name','$lastname', '$email', '$encpass', '$code', '$status', '$user', '$attempts')";
        $dataCheck = mysqli_query($conn, $insertData);
        if ($dataCheck) {
            $action = "add";
            $tableName = "users";
            $this->createLog($conn, $action, $tableName, $email);
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: domagojperic3@gmail.com";
            $this->sendVerificationCode($email, $subject, $message, $sender);
            return true;
        } else {
            header('location: Signup.php?message=Failed while inserting data in database!');
            return false;
        }
    }
     public function sendVerificationCode($email, $subject, $message, $sender)
    {
        if (mail($email, $subject, $message, $sender)) {
            header('location: ../ActivateAccount/ActivateAccount.php?message=We have sent a verification code to your email');
            exit();
        } else {
            header('location: Signup.php?message=Message was not send!');
        }
    }
    public function update($conn, $id, $name, $lastname, $email, $password, $code, $status, $user, $attempts){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users
            SET name = '$name', lastname = '$lastname', email = '$email', password = '$encpass', code = $code, status = '$status', user = '$user', attempts = $attempts
            WHERE id = $id";
             $result = mysqli_query($conn, $sql);
             if($result){
                 echo ("<script>alert('The user is updated');</script>");
                 return true;
             }else{
                 echo ("<script>alert('Failed to update user');</script>");
                 return false;
             }
    }
    public function deleteAccount($conn, $id){
        $sql = "DELETE FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo ("<script>alert('The user is deleted');</script>");
            return true;
        }else{
            echo ("<script>alert('Failed to delete user');</script>");
            return false;
        }
    }
    public function activateAccount($conn, $id){
        $sql = "UPDATE users SET status = 'verified', code = 0, attempts = 0 WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo ("<script>alert('Account is activated');</script>");
            return true;
        }else{
            echo ("<script>alert('Failed to activate account');</script>");
            return false;
        }
    }
    public function lockAccount($conn, $id){
        $sql = "UPDATE users SET code = 1 WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo ("<script>alert('Account is locked');</script>");
            return true;
        }else{
            echo ("<script>alert('Failed to lock account');</script>");
            return false;
        }
    }
    public function createAdmin($conn, $id){
        $sql = "UPDATE users SET user = 'admin' WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo ("<script>alert('Admin is created');</script>");
            return true;
        }else{
            echo ("<script>alert('Failed to create admin');</script>");
            return false;
        }
    }
}

?>