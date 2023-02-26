<?php
$title = "Login";
require_once("../../Templates/VisitorsHeader.php");
require("Functions.php");
?>
<div class="loginFrm">

    <form action="Login.php" method="POST" class="form">
        <h1 class="title">Login</h1>

        <div class="inputContainer">
            <input type="text" class="input" name="email" placeholder="Email">
            <label for="" class="label">Email</label>
        </div>

        <div class="inputContainer">
            <input type="password" class="input" name="password" placeholder="Password">
            <label for="" class="label">Password</label>
        </div>
        <div id="recaptcha"><div class="g-recaptcha" data-sitekey="6Lek9dUjAAAAAO9y5EFbMgLFENGAHHsS_gzDct-m"></div></div>


        <input type="submit" class="submitBtn" name="submit" value="Login">

        <div>
            <?php 
            if(isset($_GET['message'])){
                $message = $_REQUEST['message'];
                echo ("<span style='color:red';>$message</span><br>");
            }
            ?>
        </div>

        <p>You don't have account? <a href="../SignUp/SignUp.php">Create account</a> </p>
        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <?php require_once("../../Templates/VisitorsFooter.php"); ?>