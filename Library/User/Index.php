<?php
$title = "Home";
require_once("../Templates/UserHeader.php");
?>

<div class="responsiveContainer">
	<?php include("BooksFunctions.php"); ?>
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
	<form action="Index.php" method="post">
		<input type="text" name="searchField" id="searchField">
		<input type="submit" value="Search" name="search" id="search">
	</form>
	
	

<?php require_once("../Templates/UserFooter.php"); ?>