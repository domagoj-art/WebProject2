<?php
$title = "Contact me";
require_once("../../Templates/VisitorsHeader.php");
require("Function.php");
?>

<div class="contactFrm">

    <form action="ContactMe.php" class="form" method="POST">
        <h1 class="title">Text me</h1>

        <div class="inputContainer">
            <input type="text" name="recipient" id="recipient" class="input" placeholder="Recipient">
            <label for="" class="label">Recipient</label>
        </div>

        <div class="inputContainer">
            <input type="text" name="subject" id="subject" class="input" placeholder="Subject">
            <label for="" class="label">Subject</label>
        </div>

        <div class="messageContainer">
            <textarea placeholder="Message" class="input" name="message" id="message" cols="30" rows="10"></textarea>
            <label for="" class="label"></label>
        </div>

        <input type="submit" class="submitBtn" name="send" value="Send">
        <p>You don't have account? <a href="../SignUp/SignUp.php">Create account</a> </p>
        <?php require_once("../../Templates/VisitorsFooter.php"); ?>