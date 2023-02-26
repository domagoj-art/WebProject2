<?php
include("Database/Connection.php");


    $sql = "SELECT author, title FROM books LIMIT 0, 50";
$result = $conn->query($sql);
echo "<table id='books'>";
echo '<tr>';
echo '<th>Author</th>';
echo '<th>Title</th>';
echo '</tr>';
while ($row = $result->fetch_array()) {
    $author = $row['author'];
    $title = $row['title'];
    echo "<tr>";
    echo "<td>$author</td>";
    echo "<td>$title</td>";
    echo "</tr>";
   
}
echo "</table>";
$result->close();

?>
