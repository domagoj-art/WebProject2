<?php
require("../Database/Connection.php");
require("../Class/PaginationClass.php");
require("../Class/LogsClass.php");
$archivePagination = new Pagination();
$table = "archive";
$resultPerPage = $archivePagination->resultPerPage($conn);
$pageNo = $archivePagination->pageNo();
$getPage = $archivePagination->getPage();
$prevPage = $archivePagination->prevPage($pageNo);
$totalPages = $archivePagination->getTotalPages($conn, $resultPerPage, $table);
$nextPage = $archivePagination->nextPage($pageNo, $totalPages);

function archiveView($conn, $pageNo, $resultPerPage)
{

    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM archive 
             JOIN books ON archive.bookId = books.id
             JOIN users ON archive.userId = users.id
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>Author</th>';
    echo '<th>Title</th>';
    echo '<th>Status</th>';
    echo '<th>userID</th>';
    echo '<th>name</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $author = $row['author'];
        $title = $row['title'];
        $name = $row['name'];
        $status = $row['bookStatus'];
        $id = $row['userId'];
        echo "<tr>";
        echo "<td>$author</td>";
        echo "<td>$title</td>";
        echo "<td>$status</td>";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        //echo "<td><a href='?id=$id'>return</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}
function deleteEverything($conn)
{
    $sql = "DELETE FROM archive";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $log = new Logs();
        $action = "delete";
        $tableName = "archive";
        $log->createLog($conn, $action, $tableName);
        echo ("<script>alert('The archive is deleted');</script>");
        return true;
    } else {
        echo ("<script>alert('Failed to delete the archive');</script>");
        return false;
    }
}
if(isset($_POST['delete'])){
    deleteEverything($conn);
}
?>