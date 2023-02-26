<?php
class Logs{
    public function createLog($conn, $action, $tableName, $email = null){
        $time = time();
        $date = date("Y-m-d", $time);
        $userEmail = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$userEmail'";
        $result = mysqli_query($conn, $sql);
        $fetch = mysqli_fetch_assoc($result);
        $userId = $fetch['id'];
        $page = $_SERVER['PHP_SELF'];
        $insertData = "INSERT INTO logs(userId, time, date, action, page, tableName)
                        VALUES($userId, $time, '$date', '$action', '$page', '$tableName')";
        
        mysqli_query($conn, $insertData);
    }
}
?>