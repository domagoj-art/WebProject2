<?php
require("../Database/Connection.php");
require("../Class/PaginationClass.php");
require("../Class/LogsClass.php");
require("../Class/BookClass.php");
$booksPagination = new Pagination();
$table = "books";
$resultPerPage = $booksPagination->resultPerPage($conn);
$pageNo = $booksPagination->pageNo();
$getPage = $booksPagination->getPage();
$prevPage = $booksPagination->prevPage($pageNo);
$totalPages = $booksPagination->getTotalPages($conn, $resultPerPage, $table);
$nextPage = $booksPagination->nextPage($pageNo, $totalPages);

$book = new Book();

function booksView($conn, $pageNo, $resultPerPage)
{

    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM books 
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>code</th>';
    echo '<th>author</th>';
    echo '<th>author</th>';
    echo '<th>total</th>';
    echo '<th>available</th>';
    echo '<th>edit</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $id = $row["ID"];
        $code = $row["code"];
        $title = $row["title"];
        $author = $row["author"];
        $year = $row["releaseYear"];
        $total = $row["total"];
        $available = $row["available"];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$code</td>";
        echo "<td>$author</td>";
        echo "<td>$title</td>";
        //echo "<td>$year</td>";
        echo "<td>$total</td>";
        echo "<td>$available</td>";
        echo "<td><a href='Index.php?id=$id'>edit</a></td>";
        //echo "<td>$value</td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}
function search($conn, $pageNo, $resultPerPage, $search)
{
    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM books WHERE author = '$search' OR title = '$search'
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>code</th>';
    echo '<th>author</th>';
    echo '<th>title</th>';
    echo '<th>year</th>';
    echo '<th>total</th>';
    echo '<th>available</th>';
    echo '<th>edit</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $id = $row["ID"];
        $code = $row["code"];
        $title = $row["title"];
        $author = $row["author"];
        $year = $row["releaseYear"];
        $total = $row["total"];
        $available = $row["available"];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$code</td>";
        echo "<td>$author</td>";
        echo "<td>$title</td>";
        echo "<td>$year</td>";
        echo "<td>$total</td>";
        echo "<td>$available</td>";
        echo "<td><a href='Index.php?id=$id'>edit</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE ID = $id";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $id = $fetch["ID"];
    $code = $fetch["code"];
    $bookTitle = $fetch["title"];
    $author = $fetch["author"];
    $year = $fetch["releaseYear"];
    $total = $fetch["total"];
    $available = $fetch["available"];

}


if (!isset($_POST['search'])) {
    booksView($conn, $pageNo, $resultPerPage);

} else {
    $search = mysqli_real_escape_string($conn, $_POST['searchField']);
    search($conn, $pageNo, $resultPerPage, $search);
}

if (isset($_POST['add'])) {

    //$id =$_POST["ID"];
    $code = $_POST["code"];
    $bookTitle = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];
    $total = $_POST["total"];
    $available = $_POST["available"];
    $add = $book->addBook($conn, $code, $bookTitle, $author, $year, $total, $available);
    if ($add == true) {
        $log = new Logs();
        $action = "add";
        $tableName = "books";
        $log->createLog($conn, $action, $tableName);
    }

}

if (isset($_POST['update'])) {

    $id =$_POST["id"];
    $code = $_POST["code"];
    $bookTitle = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];
    $total = $_POST["total"];
    $available = $_POST["available"];
    $update = $book->updateBook($conn, $id, $code, $bookTitle, $author, $year, $total, $available);
    if ($update == true) {
        $log = new Logs();
        $action = "update";
        $tableName = "books";
        $log->createLog($conn, $action, $tableName);
    }

}

if (isset($_POST['delete'])) {

    $id =$_POST["id"];
    $delete = $book->deleteBook($conn, $id);
    if ($delete == true) {
        $log = new Logs();
        $action = "delete";
        $tableName = "books";
        $log->createLog($conn, $action, $tableName);
    }

}


?>