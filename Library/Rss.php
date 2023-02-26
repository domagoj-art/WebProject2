<?php 
$title = "Rss";

require_once("Database/Connection.php");
require_once("Templates/IndexHeader.php");
?>

<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">

<channel>
<br>
<br>
<br>
<br>
<br>
<br>
<?php 
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
while ($row = $result->fetch_array()) {
  $author = $row['author'];
  $title = $row['title'];
  $bookNo = 1;
  echo "<item>";
  echo "<title>$bookNo.Knjiga</title><br>";
  echo "<description>$author</description><br>";
  echo "<description>$title</description><br>";
  echo "</item><br>";
  $bookNo++;
}
?>
  
</channel>

</rss>