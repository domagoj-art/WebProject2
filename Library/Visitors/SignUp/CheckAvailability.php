<?php
require("../../Database/Connection.php");

if(!empty($_POST["name"])){
    $query = "SELECT * FROM users WHERE name='" . $_POST['name'] . "'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if($count > 0){
        
        echo ("<span style='color:red';>user alredy exists .</span>");
        echo ("<script>$('#signUp').prop('disabled',true);</script>");
    }
    else{
        
        echo ("<span style='color:green';>user availebile for registration .</span>"); 
        echo ("<script>$('#signUp').prop('disabled',false);</script>");
    }
}
if(!empty($_POST["email"])){
    $query = "SELECT * FROM users WHERE email='" . $_POST['email'] . "'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if($count > 0){
        echo ("<span style='color:red';>user alredy exists .</span>");
        echo ("<script>$('#signUp').prop('disabled',true);</script>");
    }
    else{
        echo ("<span style='color:green';>user availebile for registration .</span>"); 
        echo ("<script>$('#signUp').prop('disabled',false);</script>");
    }
}
?>