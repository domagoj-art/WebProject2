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
function getUserId($conn)
{
    $userEmail = $_SESSION['email'];
    $sql = "SELECT * from users WHERE email = '$userEmail'";
    $result = mysqli_query($conn, $sql);
    mysqli_num_rows($result);
    $fetch = mysqli_fetch_assoc($result);
    $userID = $fetch['id'];
    return $userID;
}
$userID = getUserId($conn);
function UserArchiveView($conn, $pageNo, $resultPerPage, $userID)
{

    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM archive 
            INNER JOIN books ON archive.bookId = books.id
            INNER JOIN users ON archive.userId = users.id WHERE archive.userId = $userID
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    returnBook($conn);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>Author</th>';
    echo '<th>Title</th>';
    echo '<th>Status</th>';
    echo '<th>return</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $author = $row['author'];
        $title = $row['title'];
        $name = $row['name'];
        $status = $row['bookStatus'];
        $id = $row['archiveId'];
        echo "<tr>";
        echo "<td>$author</td>";
        echo "<td>$title</td>";
        echo "<td>$status</td>";
        echo "<td><a href='?id=$id'>return</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}
function returnBook($conn)
{
    if (isset($_GET['id'])) {
        $archiveID = $_REQUEST['id'];
        $time = time();
        $sql = "SELECT * FROM archive WHERE archiveId = $archiveID";
        $result = mysqli_query($conn, $sql);
        $fetch = mysqli_fetch_assoc($result);
        $bookID = $fetch['bookId'];
        $status = "returned";
        if (checkAvailability2($conn, $bookID) == true) {
            updateBook2($conn, $bookID);
            $updateData = "UPDATE archive SET bookStatus = '$status', returnDate = $time WHERE archiveId = $archiveID";
            mysqli_query($conn, $updateData);
            $log = new Logs();
            $action = "update";
            $tableName = "archive";
            $log->createLog($conn, $action, $tableName);
        } else {
            echo ("<script>alert('The book is alredy returned!')</script>");
        }
    }
}
function updateBook2($conn, $bookID)
{
    $sql = "SELECT * FROM books WHERE id = $bookID";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $available = $fetch['available'];
    $available++;
    $updateData = "UPDATE books SET available = $available WHERE id = $bookID";
    mysqli_query($conn, $updateData);
    $log = new Logs();
    $action = "update";
    $tableName = "books";
    $log->createLog($conn, $action, $tableName);
}
function checkAvailability2($conn, $bookID)
{
    $sql = "SELECT * FROM books WHERE ID = $bookID";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $available = $fetch['available'];
    if ($available == 5) {
        return false;
    }
    return true;
}

?>