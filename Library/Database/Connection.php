<?php
$conn = mysqli_connect('localhost', 'root', 'Avavav27', 'library');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
  $conn->select_db('library');
}
?>