<?php
$title = "Books Record";
require_once("../Templates/AdminHeader.php");
?>

<div class="responsiveContainer">
    <?php include("BooksRecordFunctions.php"); ?>
    <?php archiveView($conn, $pageNo, $resultPerPage); ?>
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
</div>
<form action="BooksRecord.php" method="post">
    <button type="submit" class="" name="delete" id="">Delete All</button>
</form>


<?php
require_once("../Templates/AdminFooter.php");
?>
