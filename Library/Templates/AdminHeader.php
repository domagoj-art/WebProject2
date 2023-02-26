<?php require("Session.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="stylesheet" href="../Styles/AdminStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../JavaScript/ResponsiveNavbar.js"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="topnav" id="myTopnav">
                <div class="dropdown">
                    <button class="dropbtn"><i class="fa fa-book"></i> Books Administration
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="BooksRecord.php">Books Record</a>
                        <a href="Index.php">Books Administration</a>

                    </div>
                </div>

                <a href="UserAdministration.php"><i class="fa fa-user"></i> User Administration</a>
                <div class="dropdown">
                    <button class="dropbtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Administration
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="WebConfig.php">Web Configuration</a>
                        <a href="Statistics.php">Statistics</a>
                        <a href="Logs.php">Track Changes</a>
                        <a href="RecoverData.php">Data Backup</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="dropbtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> About
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="Author.php">Author</a>
                        <a href="Documentation.php">Documentation</a>

                    </div>
                </div>


                <a href="../Logout/Logout.php" class="sign-out"><i class="fa fa-sign-out"></i></a>
                <a href="javascript:void(0);" style="font-size:15px;" class="icon"
                    onclick="responsiveNavbar()">&#9776;</a>
            </div>
        </div>