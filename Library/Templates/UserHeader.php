<?php 
require("Session.php");
?>
<?php 
if($_SERVER['SERVER_PROTOCOL'] = 'http'){
    header('https/WebProject2/Library/Visitors/Login/Login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../Styles/UserStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="container">
        <div class="header">
            <div class="topnav" id="myTopnav">
                <a class="link" href="../User/Index.php"><i class="fa fa-book"></i> BOOKS</a>
                <a  class="link" href="../User/Archive.php"><i class="fa fa-archive"></i> ARCHIVE</a>
                <a href="../Logout/Logout.php" class="sign-out" ><i class="fa fa-sign-out"></i></a>
                <a href="javascript:void(0);" class="icon" onclick="ResponsiveNavbar()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
        
