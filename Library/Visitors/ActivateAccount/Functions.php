<?php
require("../../Database/Connection.php");
//require("../../Class/LogsClass.php");
require("../../Class/UserClass.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $code = mysqli_real_escape_string($conn, $_POST['code']);

    Activate($conn, $code, $email);
}
function activate($conn, $code, $email)
{
    if (acctivityStatus($conn, $email) == true) {
        codeMatch($code, $email, $conn);
    }
}
function update($email, $conn)
{
    $status = 'verified';
    $code = 0;
    $updateUser = "UPDATE users SET code = $code, status = '$status' WHERE email = '$email'";
    $updateResult = mysqli_query($conn, $updateUser);
    if ($updateResult) {
        $log = new User();
        $action = "update";
        $tableName = "users";
        $log->createLog($conn, $action, $tableName, $email);
        header('location: ../Login/Login.php?message=Your account is astive!.php');
        exit();
    } else {
        header("location: ActivateAccount.php?message=Failed while trying to update database!");
    }
}
function codeMatch($code, $email, $conn)
{
    $sql = "SELECT code FROM users WHERE email = '$email'";
    $checkCode = $conn->query($sql);
    if (mysqli_num_rows($checkCode) > 0) {
        $fetchData = mysqli_fetch_assoc($checkCode);
        $fetchCode = $fetchData['code'];
        //AcctivityStatus($fetchCode);
        if ($fetchCode != $code) {
            header("location: ActivateAccount.php?message=Code do not match");

        } else {
            update($email, $conn);
        }

    } else {

        header("location: ActivateAccount.php?message=Your account is not in database");

    }
}
function acctivityStatus($conn, $email)
{
    $sql = "SELECT code FROM users WHERE email = '$email'";
    $checkCode = $conn->query($sql);
    if ($checkCode == 0) {
        header('location: ../Login/Login.php?message=Your account is all ready activated!!.php');
        return false;
    } elseif ($checkCode < 0) {
        header('location: ../ContactMe/ContactMe.php?message=Your account has been blocked! Contact me!');
        return false;
    }
    return true;
}

?>