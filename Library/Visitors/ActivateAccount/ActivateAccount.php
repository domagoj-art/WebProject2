<?php
$title = "Activate Account";
require_once("../../Templates/VisitorsHeader.php");
require("Functions.php");
?>
<div class="loginFrm">

    <form action="ActivateAccount.php" class="form" method="POST">
        <h1 class="title">Activate Account</h1>

        <div class="inputContainer">
            <input type="text" name="email" class="input" placeholder="Email">
            <label for="" class="label">Email</label>
        </div>

        <div class="inputContainer">
            <input type="text" class="input" name="code" placeholder="Verification code">
            <label for="" class="label">Verification code</label>
        </div>
        
        <div>
            <?php 
            if(isset($_GET['message'])){
                $message = $_REQUEST['message'];
                echo ("<span style='color:red';>$message</span><br>");
            }
            ?>
        </div>

        <input type="submit" class="submitBtn" name="submit" value="Submit">
        <p>You don't have account? <a href="../SignUp/SignUp.php">Create account</a> </p>
    
        <p>Do you want to <a href="../../Index.php">activate account?</a> </p>
        <?php require_once("../../Templates/VisitorsFooter.php"); ?>