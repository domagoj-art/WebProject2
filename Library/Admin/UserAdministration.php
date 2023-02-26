<?php
$title = "User Admnistration";
require_once("../Templates/AdminHeader.php");
?>

<div class="responsiveContainer">
    <?php include("UserAdministrationFunctions.php"); ?>
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
    <form action="UserAdministration.php" method="POST">
		<input type="text" name="searchField" id="searchField">
		<input type="submit" value="Search" name="searchUser" id="searcUser">
	</form><br><br>
    </div>
    <div class="form">
    <form action="UserAdministration.php" method="POST">
        <input type="text" name="id" id="" placeholder="id" value="<?php echo $id = (empty($id)) ? "" : $id; ?>"><br>
        <input type="text" name="name" id="" placeholder="name" value="<?php echo $name = (empty($name)) ? "" : $name; ?>"><br>
        <input type="text" name="lastname" id="" placeholder="lastname" value="<?php echo $lastname = (empty($lastname)) ? "" : $lastname; ?>"><br>
        <input type="text" name="email" id="" placeholder="email" value="<?php echo $email = (empty($email)) ? "" : $email; ?>"><br>
        <input type="text" name="password" id="" placeholder="password" value="<?php echo $password = (empty($password)) ? "" : $password; ?>"><br>
        <input type="text" name="status" id="" placeholder="status" value="<?php echo $status = (empty($status)) ? "" : $status; ?>"><br>
        <input type="text" name="code" id="" placeholder="code" value="<?php echo $code = (empty($code)) ? 0 : $code; ?>"><br>
        <input type="text" name="user" id="" placeholder="user" value="<?php echo $user = (empty($user)) ? "" : $user; ?>"><br>
        <input type="text" name="attempts" id="" placeholder="attempts" value="<?php echo $attempts = (empty($attempts)) ? 0 : $attempts; ?>"><br>
        <input type="submit" value="Add" name="add" class="button" id=""><br>
        <input type="submit" value="Update" name="update" class="button" id=""><br>
        <input type="submit" value="Delete" name="delete" class="button" id=""><br>
        <input type="submit" value="activate" name="activate" class="button" id=""><br>
        <input type="submit" value="lock" name="lock" class="button" id=""><br>
        <input type="submit" value="create admin" name="admin" class="button" id=""><br>
	</form>
    </div>

    
</div>




<?php
require_once("../Templates/AdminFooter.php");
?>
