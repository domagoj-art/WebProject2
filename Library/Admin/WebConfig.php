<?php
$title = "Web Configuration";
require_once("../Templates/AdminHeader.php");
require("../Database/Connection.php");
require("../Class/LogsClass.php");
function getPagination($conn)
{
    $sql = "SELECT * FROM config";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $pagination = $fetch['pagination'];
    echo "Current number of pagination is: $pagination <br>";
}
function getAttempts($conn)
{
    $sql = "SELECT * FROM config";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $attempts = $fetch['attempts'];
    echo "Current number of attemps is: $attempts <br>";
}
function changeConfig($conn, $attempts, $pagination)
{
    $sql = "UPDATE config SET attempts = $attempts, pagination = $pagination";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $log = new Logs();
        $action = "update";
        $tableName = "users";
        $log->createLog($conn, $action, $tableName);
    } else {
        echo ("<script>alert('Failed');</script>");
    }
}
if (isset($_POST['submit'])) {
    $attempts = $_POST['attempts'];
    $pagination = $_POST['pagination'];
    changeConfig($conn, $attempts, $pagination);
}
?>
 <div class="form2">
<form action="" method="post">
    <?php getAttempts($conn) ?>
    
    <input type="text" name="attempts" placeholder="Attempts"><br>
    <?php getPagination($conn) ?>
    
    <input type="text" name="pagination" placeholder="Pagination"><br>
    <input type="submit" class="button" name="submit">
</form><br>
</div>

<?php
require_once("../Templates/AdminFooter.php");
?>