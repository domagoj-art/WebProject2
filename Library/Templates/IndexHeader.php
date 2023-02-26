<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="Styles/IndexStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="JavaScript/ResponsiveNavbar.js"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="topnav" id="myTopnav">
                <a class="link" href="Visitors/ContactMe/ContactMe.php"><i class="fa fa-envelope"></i> Contact me</a>
                <a class="link" href="Rss.php">Rss</a>
                <a  class="link sign-in" href="Visitors/Login/Login.php"><i class="fa fa-sign-in"></i> Login</a>
                <a href="javascript:void(0);" class="icon" onclick="ResponsiveNavbar()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>