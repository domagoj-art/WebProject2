<?php
$title = "Archive";
require_once("../Templates/UserHeader.php");
?>

<div class="responsiveContainer">
    <?php include("ArchiveFunctions.php"); ?>
    <?php UserArchiveView($conn, $pageNo, $resultPerPage, $userID); ?>
    Prethodna stranica
    <a href="?pageNo=<?= max(($pageNo - 1), 1) ?>">
        <?php echo $prevPage; ?>
    </a>
    <span>
        <?php echo $getPage; ?>
    </span>
    <a href="?pageNo=<?= min(($pageNo + 1), $totalPages) ?>">
        <?php echo $nextPage; ?>
    </a>
    Sljedeća stranica

</div>

<?php require_once("../Templates/UserFooter.php"); ?>