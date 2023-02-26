<?php
require("../Database/Connection.php");
require("../Class/PaginationClass.php");
require("../Class/LogsClass.php");
$bookPagination = new Pagination();
$table = "books";
$resultPerPage = $bookPagination->resultPerPage($conn);
$pageNo = $bookPagination->pageNo();
$getPage = $bookPagination->getPage();
$prevPage = $bookPagination->prevPage($pageNo);
$totalPages = $bookPagination->getTotalPages($conn, $resultPerPage, $table);
$nextPage = $bookPagination->nextPage($pageNo, $totalPages);
function userBookView($conn, $pageNo, $resultPerPage)
{

    $initialPage = $pageNo - 1;
    $sql2 = "SELECT	* FROM books LIMIT " . ($initialPage * $resultPerPage) . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>Author</th>';
    echo '<th>Title</th>';
    echo '<th>Available</th>';
    echo '<th>rent</th>';
    echo '</tr>';
    bookRent($conn);
    while ($row = $result2->fetch_array()) {
        $author = $row['author'];
        $title = $row['title'];
        $available = $row['available'];
        $id = $row['ID'];
        echo "<tr>";
        echo "<td>$author</td>";
        echo "<td>$title</td>";
        echo "<td>$available</td>";
        echo "<td><a href='?id=$id'>rent</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}

function bookRent($conn)
{
    if (isset($_GET['id'])) {
        $userEmail = $_SESSION['email'];
        $bookID = $_REQUEST['id'];
        $time = time();
        $sql = "SELECT * FROM users WHERE email = '$userEmail'";
        $result = mysqli_query($conn, $sql);
        mysqli_num_rows($result);
        $fetch = mysqli_fetch_assoc($result);
        $userID = $fetch['id'];
        if (checkAvailability($conn, $bookID) == true) {
            $insertData = "INSERT INTO archive (userId, bookId, rentDate)
                            VALUES($userID, $bookID, $time)";
            $dataCheck = mysqli_query($conn, $insertData);
            if ($dataCheck == true) {
                updateBook($conn, $bookID);
                $log = new Logs();
                $action = "update";
                $tableName = "archive";
                $log->createLog($conn, $action, $tableName);
                echo ("<script>alert('Book is rented!')</script>");
            } else {
                echo ("<script>alert('Failed!')</script>");
            }
        } else {
            echo ("<script>alert('There is no more books for renting!')</script>");
        }
    }
}
function updateBook($conn, $bookID)
{
    $sql = "SELECT * FROM books WHERE id = $bookID";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $available = $fetch['available'];
    $available--;
    $updateData = "UPDATE books SET available = $available WHERE id = $bookID";
    mysqli_query($conn, $updateData);
    $log = new Logs();
    $action = "update";
    $tableName = "books";
    $log->createLog($conn, $action, $tableName);
}
function checkAvailability($conn, $bookID)
{
    $sql = "SELECT * FROM books WHERE id = $bookID";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $available = $fetch['available'];
    if ($available <= 0) {
        return false;
    }
    return true;
}
function searchBook($conn, $pageNo, $resultPerPage, $search)
{
    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM books WHERE author = '$search' OR title = '$search'
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>Author</th>';
    echo '<th>Title</th>';
    echo '<th>Available</th>';
    echo '<th>rent</th>';
    echo '</tr>';
    bookRent($conn);
    while ($row = $result2->fetch_array()) {
        $author = $row['author'];
        $title = $row['title'];
        $available = $row['available'];
        $id = $row['ID'];
        echo "<tr>";
        echo "<td>$author</td>";
        echo "<td>$title</td>";
        echo "<td>$available</td>";
        echo "<td><a href='?id=$id'>rent</a></td>";
        echo "</tr>";
    }
    echo "</table>";


    $result2->close();
}
if (!isset($_POST['search'])) {
    userBookView($conn, $pageNo, $resultPerPage);

} else {
    $search = mysqli_real_escape_string($conn, $_POST['searchField']);
    searchBook($conn, $pageNo, $resultPerPage, $search);
}

?>