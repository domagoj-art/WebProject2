<?php
$title = "Books Admnistration";
require_once("../Templates/AdminHeader.php");
?>
<div class="responsiveContainer">
    
    <?php include("IndexFunctions.php"); ?>
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
   <div class="search">
    <form action="Index.php" method="POST">
		<input type="text" name="searchField" id="searchField">
        <button type="submit" class="searchbtn" name="search" id="searchField" ><i class="fa fa-search" aria-hidden="true"></i></button>
		
	</form><br><br>
    </div>
    <div class="form">
    <form action="Index.php" method="POST">
        <input type="text" name="id" id="" placeholder="id" value="<?php echo $id = (empty($id)) ? "" : $id; ?>"><br>
        <input type="text" name="code" id="" placeholder="code" value="<?php echo $code = (empty($code)) ? "" : $code; ?>"><br>
        <input type="text" name="author" id="" placeholder="author" value="<?php echo $author = (empty($author)) ? "" : $author; ?>"><br>
        <input type="text" name="title" id="" placeholder="title" value="<?php echo $bookTitle = (empty($bookTitle)) ? "" : $bookTitle; ?>"><br>
        <input type="text" name="year" id="" placeholder="year" value="<?php echo $year = (empty($year)) ? "" : $year; ?>"><br>
        <input type="text" name="total" id="" placeholder="total" value="<?php echo $total = (empty($total)) ? "" : $total; ?>"><br>
        <input type="text" name="available" id="" placeholder="available" value="<?php echo $available = (empty($available)) ? "" : $available; ?>"><br>
        <input type="submit" class="button" value="Add" name="add" id=""><br>
        <input type="submit" class="button" value="Update" name="update" id=""><br>
        <input type="submit" class="button" value="Delete" name="delete" id=""><br>
	</form>
    </div>
    
</div>




<?php
require_once("../Templates/AdminFooter.php");
?>

