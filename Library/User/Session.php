<?php
session_start();
    if (!isset($_SESSION['id'])) {
        
        header("Location: ../Visitors/Login/Login.php");
    }
    else{
        if($_SESSION['id'] != 1){
            header("Location: ../Visitors/Login/Login.php");
        }
    }

?>