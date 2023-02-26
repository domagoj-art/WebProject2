<?php
require("../Database/Connection.php");
require("../Class/LogsClass.php");
session_start();
function logoutStatistics($conn){
    $userEmail = $_SESSION['email'];
    $time = time();
    $logoutDate = date('Y-m-d H:i:s', $time);
    $sql = "SELECT * FROM users WHERE email = '$userEmail'";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $userId = $fetch['id'];
    $updateData = "UPDATE loginStatistics
                    SET logoutDate = '$logoutDate', logoutStamp = $time
                    WHERE userId = $userId AND logoutDate = '0000-00-00 00:00:00'
                    ORDER BY logoutDate DESC LIMIT 1";
    $check = mysqli_query($conn, $updateData);
    if ($check ) {
        $logs = new Logs();
        $action = "add";
        $tableName = "loginStatistics";
        $logs->createLog($conn, $action, $tableName);
    }
}
logoutStatistics($conn);
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../Visitors/Login/Login.php');
    exit();

?>