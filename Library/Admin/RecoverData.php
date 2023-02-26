<?php
$title = "Data Backup";
require_once("../Templates/AdminHeader.php");
require("RecoverDataFunctions.php");
?>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>

<p></p>
<p></p>
<p></p>
<p></p>
<h1>click on button to recover data</h1>
<form action="RecoverData.php" method="POST">
    <input type="submit" value="recover" name="submit">
</form>


<form method="post" action="" enctype="multipart/form-data" id="frm-restore">
    <div class="form-row">
        <div>Choose Backup File</div>
        <div>
            <input type="file" name="backup_file" class="input-file" />

        </div>
    </div>
    <div>
        <input type="submit" name="restore" value="Restore" class="btn-action" />
    </div>
</form>



<div>
    <?php
    if (isset($_GET['message'])) {
        $message = $_REQUEST['message'];
        echo ("<span style='color:red';>$message</span><br>");
    }
    ?>
</div>



<?php
require_once("../Templates/AdminFooter.php");
?>