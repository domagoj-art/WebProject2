<?php
require("../Database/Connection.php");
require("../Class/PaginationClass.php");
$LogsPagination = new Pagination();
$table = "logs";
$resultPerPage = $LogsPagination->resultPerPage($conn);
$pageNo = $LogsPagination->pageNo();
$getPage = $LogsPagination->getPage();
$prevPage = $LogsPagination->prevPage($pageNo);
$totalPages = $LogsPagination->getTotalPages($conn, $resultPerPage, $table);
$nextPage = $LogsPagination->nextPage($pageNo, $totalPages);

function LogsView($conn, $pageNo, $resultPerPage)
{

    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM logs 
             LEFT JOIN users ON logs.userId = users.id
            LIMIT  $results, $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>UserID</th>';
    echo '<th>Name</th>';
    echo '<th>Lastname</th>';
    echo '<th>Date</th>';
    echo '<th>Action</th>';
    echo '<th>Page</th>';
    echo '<th>Table Name</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $id = $row['logId'];
        $userId = $row['userId'];
        $name = $row['name'];
        $lastname = $row['lastname'];
        $date = $row['date'];
        $action = $row['action'];
        $page = $row['page'];
        $tableName = $row['tableName'];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$userId</td>";
        echo "<td>$name</td>";
        echo "<td>$lastname</td>";
        echo "<td>$date</td>";
        echo "<td>$action</td>";
        echo "<td>$page</td>";
        echo "<td>$tableName</td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}



function searchByDate($conn, $id, $fromDate, $toDate, $pageNo, $resultPerPage){
    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM logs 
             JOIN users ON logs.userId = users.id 
             WHERE userId = $id AND time >= $fromDate AND time <= $toDate ";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>UserID</th>';
    echo '<th>Name</th>';
    echo '<th>Lastname</th>';
    echo '<th>Date</th>';
    echo '<th>Action</th>';
    echo '<th>Page</th>';
    echo '<th>Table Name</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $id = $row['logId'];
        $userId = $row['userId'];
        $name = $row['name'];
        $lastname = $row['lastname'];
        $date = $row['date'];
        $action = $row['action'];
        $page = $row['page'];
        $tableName = $row['tableName'];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$userId</td>";
        echo "<td>$name</td>";
        echo "<td>$lastname</td>";
        echo "<td>$date</td>";
        echo "<td>$action</td>";
        echo "<td>$page</td>";
        echo "<td>$tableName</td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}

function selectUserId($conn){
    $sql = "SELECT * FROM users";
    $result2 = $conn->query($sql);
    echo "<select name='userId' id='userId'>";
    while ($row = $result2->fetch_array()) {
        $id = $row['id'];
        $name = $row['name'];
        echo "<option value='$id'>$name</option>";
    }
    echo "</select>";

}

if(!isset($_POST['submit'])){
    LogsView($conn, $pageNo, $resultPerPage);
}
else{
    $id = $_POST['userId'];
    $timeStamp1 = $_POST['fromDate'];
    $timeStamp2 = $_POST['toDate'];
    $fromDate = strtotime($timeStamp1);
    $toDate = strtotime($timeStamp2);
    searchByDate($conn, $id, $fromDate, $toDate, $pageNo, $resultPerPage);
}
?>