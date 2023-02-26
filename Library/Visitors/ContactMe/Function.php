<?php
$recipient = "";
if (isset($_POST['send'])) {
    //access user entered data
    $recipient = mysqli_real_escape_string($conn, $_POST['recipient']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $sender = "From: domagojperic@gmail.com";

    if (mail($recipient, $subject, $message, $sender)) {
        echo ("<script>alert('message send!')</script>");
    } else {
        echo ("<script>alert('message was not send!')</script>");
    }
}
?>