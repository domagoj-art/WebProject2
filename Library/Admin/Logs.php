<?php
$title = "Logs";
require_once("../Templates/AdminHeader.php");
require_once("LogsFunctions.php");
?>
<div class="responsiveContainer">
<div class="pages">
    <span class="Previous" >Previous page</span>
    <a href="?pageNo=<?= max(($pageNo - 1), 1) ?>">
        <?php echo $prevPage; ?>
    </a>
    <span class="current">
        <?php echo $getPage; ?>
    </span>
    <a href="?pageNo=<?= min(($pageNo + 1), $totalPages) ?>">
        <?php echo $nextPage; ?>
    </a>

    <span class="next" >next page</span>
    </div>
    <div class="form">
    <form action="Logs.php" method="post">
        <label for="">From date</label>
        <input type="date" id="fromDate" name="fromDate"><br>
        <label for="">To date</label>
        <input type="date" id="toDate" name="toDate"><br>
        <label for="">User ID</label>
        <?php selectUserId($conn);?><br>
        <input type="submit" class="button" name="submit">
    </form>
    </div>
</div>




<?php
require_once("../Templates/AdminFooter.php");
?>