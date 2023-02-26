<?php
require("../Database/Connection.php");
require("../Class/PaginationClass.php");
//include("../Class/LogsClass.php");
include("../Class/UserClass.php");
$usersPagination = new Pagination();
$table = "users";
$resultPerPage = $usersPagination->resultPerPage($conn);
$pageNo = $usersPagination->pageNo();
$getPage = $usersPagination->getPage();
$prevPage = $usersPagination->prevPage($pageNo);
$totalPages = $usersPagination->getTotalPages($conn, $resultPerPage, $table);
$nextPage = $usersPagination->nextPage($pageNo, $totalPages);

$newUser = new User();

function usersView($conn, $pageNo, $resultPerPage)
{

    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM users 
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th><a href="UserAdministration.php?filter=name">name</a></th>';
    echo '<th><a href="UserAdministration.php?filter=lastname">lastname</a></th>';
    echo '<th>email</th>';
    echo '<th>password</th>';
    echo '<th>status</th>';
    echo '<th>code</th>';
    echo '<th>user</th>';
    echo '<th>attempts</th>';
    echo '<th>edit</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $id = $row["id"];
        $name = $row["name"];
        $lastname = $row["lastname"];
        $email = $row["email"];
        $password = $row["password"];
        $status = $row["status"];
        $code = $row["code"];
        $user = $row["user"];
        $attempts = $row["attempts"];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>$lastname</td>";
        echo "<td>$email</td>";
        echo "<td>$password</td>";
        echo "<td>$status</td>";
        echo "<td>$code</td>";
        echo "<td>$user</td>";
        echo "<td>$attempts</td>";
        echo "<td><a href='UserAdministration.php?id=$id'>edit</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}
function orderByName($conn, $pageNo, $resultPerPage, $filter)
{

    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM users ORDER BY $filter
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th><a href="UserAdministration.php?filter=name">name</a></th>';
    echo '<th><a href="UserAdministration.php?filter=lastname">lastname</a></th>';
    echo '<th>email</th>';
    echo '<th>password</th>';
    echo '<th>status</th>';
    echo '<th>code</th>';
    echo '<th>user</th>';
    echo '<th>attempts</th>';
    echo '<th>edit</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $id = $row["id"];
        $name = $row["name"];
        $lastname = $row["lastname"];
        $email = $row["email"];
        $password = $row["password"];
        $status = $row["status"];
        $code = $row["code"];
        $user = $row["user"];
        $attempts = $row["attempts"];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>$lastname</td>";
        echo "<td>$email</td>";
        echo "<td>$password</td>";
        echo "<td>$status</td>";
        echo "<td>$code</td>";
        echo "<td>$user</td>";
        echo "<td>$attempts</td>";
        echo "<td><a href='UserAdministration.php?id=$id'>edit</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}
function searchUser($conn, $pageNo, $resultPerPage, $search)
{
    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM users WHERE name = '$search' OR lastname = '$search'
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th><a href="UserAdministration.php?filter=name">name</a></th>';
    echo '<th><a href="UserAdministration.php?filter=lastname">lastname</a></th>';
    echo '<th>email</th>';
    echo '<th>password</th>';
    echo '<th>status</th>';
    echo '<th>code</th>';
    echo '<th>user</th>';
    echo '<th>attempts</th>';
    echo '<th>edit</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $id = $row["id"];
        $name = $row["name"];
        $lastname = $row["lastname"];
        $email = $row["email"];
        $password = $row["password"];
        $status = $row["status"];
        $code = $row["code"];
        $user = $row["user"];
        $attempts = $row["attempts"];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>$lastname</td>";
        echo "<td>$email</td>";
        echo "<td>$password</td>";
        echo "<td>$status</td>";
        echo "<td>$code</td>";
        echo "<td>$user</td>";
        echo "<td>$attempts</td>";
        echo "<td><a href='UserAdministration.php?id=$id'>edit</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);

    $id = $fetch["id"];
    $name = $fetch["name"];
    $lastname = $fetch["lastname"];
    $email = $fetch["email"];
    $password = $fetch["password"];
    $status = $fetch["status"];
    $code = $fetch["code"];
    $user = $fetch["user"];
    $attempts = $fetch["attempts"];
    usersView($conn, $pageNo, $resultPerPage);
}
elseif (isset($_POST['searchUser'])) {
    //usersView($conn, $pageNo, $resultPerPage);
    //orderByName($conn, $pageNo, $resultPerPage);

    $search = mysqli_real_escape_string($conn, $_POST['searchField']);
    searchUser($conn, $pageNo, $resultPerPage, $search);
} 
elseif (isset($_POST['add'])) {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $code = mysqli_real_escape_string($conn, $_POST["code"]);
    $user = mysqli_real_escape_string($conn, $_POST["user"]);
    $attempts = mysqli_real_escape_string($conn, $_POST["attempts"]);
    $add = $newUser->createUser($conn, $name, $email, $password, $lastname);
    if ($add == true) {
        $log = new Logs();
        $action = "add";
        $tableName = "users";
        $log->createLog($conn, $action, $tableName);
        usersView($conn, $pageNo, $resultPerPage);
    }
}

elseif (isset($_POST['update'])) {

    
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $code = mysqli_real_escape_string($conn, $_POST["code"]);
    $user = mysqli_real_escape_string($conn, $_POST["user"]);
    $attempts = mysqli_real_escape_string($conn, $_POST["attempts"]);
    $update = $newUser->update($conn, $id, $name, $lastname, $email, $password, $code, $status, $user, $attempts);
    if ($update == true) {
        $log = new Logs();
        $action = "update";
        $tableName = "users";
        $log->createLog($conn, $action, $tableName);
        usersView($conn, $pageNo, $resultPerPage);
    }
}

elseif (isset($_POST['delete'])) {

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $delete = $newUser->deleteAccount($conn, $id);
    if ($delete == true) {
        $log = new Logs();
        $action = "delete";
        $tableName = "users";
        $log->createLog($conn, $action, $tableName);
        usersView($conn, $pageNo, $resultPerPage);
        
    }
}
elseif (isset($_POST['activate'])) {

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $activate = $newUser->activateAccount($conn, $id);
    if ($activate == true) {
        $log = new Logs();
        $action = "update";
        $tableName = "users";
        $log->createLog($conn, $action, $tableName);
        usersView($conn, $pageNo, $resultPerPage);
    }
}
elseif (isset($_POST['lock'])) {

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $lock = $newUser->lockAccount($conn, $id);
    if ($lock == true) {
        $log = new Logs();
        $action = "update";
        $tableName = "users";
        $log->createLog($conn, $action, $tableName);
        usersView($conn, $pageNo, $resultPerPage);
    }
}
elseif (isset($_POST['admin'])) {

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $admin = $newUser->createAdmin($conn, $id);
    if ($admin == true) {
        $log = new Logs();
        $action = "update";
        $tableName = "users";
        $log->createLog($conn, $action, $tableName);
        usersView($conn, $pageNo, $resultPerPage);
    }
}
elseif(isset($_GET['filter'])){
    $filter = $_GET['filter'];
    orderByName($conn, $pageNo, $resultPerPage, $filter);
    
}
else{
    usersView($conn, $pageNo, $resultPerPage);
}

?>