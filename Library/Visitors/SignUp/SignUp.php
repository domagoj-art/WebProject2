<?php
$title = "Sign up";
require_once("../../Templates/VisitorsHeader.php");
?>

<div class="signupFrm">
    <form action="SignUp.php" class="form" method="POST" onsubmit="validate()">
        <h1 class="title">Sign up</h1>

        <?php require("Functions.php"); ?>
        <span id="emailSpan"></span>
        <div class="inputContainer">
            <input type="text" class="input" id="email" name="email" placeholder="Email" oninput="checkEmail();">
            <label for="" class="label">Email</label>
        </div>


        <span id="userNameSpan"></span>
        <div class="inputContainer">
            <input type="text" class="input" id="username" name="username" placeholder="Username"
                oninput="checkUsername();">
            <label for="" class="label">Username</label>
        </div>

        <div class="inputContainer">
            <input type="text" class="input" id="lastname" name="lastname" placeholder="Lastname">
            <label for="" class="label">Lastname</label>
            <span id="lastnameSpan"></span>
        </div>

        <div class="inputContainer">
            <span></span>
            <input type="password" class="input" id="password" name="password" placeholder="password">
            <label for="" class="label">Password</label>
            <span id="passwordSpan"></span>
        </div>

        <div class="inputContainer">
            <input type="password" class="input" id="confirmPassword" name="confirmPassword" placeholder="confirmPassword">
            <label for="" class="label">Confirm Password</label>
            <span id="confirmPasswordSpan"></span>
        </div>

        <div>
            <?php
            if (isset($_GET['message'])) {
                $message = $_REQUEST['message'];
                echo ("<span style='color:red';>$message</span><br>");
            }
            ?>
        </div>
        <input type="submit" class="submitBtn" name="signUp" id="signUp" value="Sign up">


    

        <p>Allredy have account? <a href="../Login/Login.php">Login</a> </p>
        
        <p>Do you want to <a href="../../Index.php">activate account?</a> </p>
        <script src="../../JavaScript/Ajax.js"></script>
        <script src="../../JavaScript/ClientValidation.js"></script>
        <script src="../../JavaScript/jquery-3.6.2.min.js"></script>
        <?php require_once("../../Templates/VisitorsFooter.php"); ?>

        <script>

            
        </script>