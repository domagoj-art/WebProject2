<?php
include("../Database/Connection.php");
$mysqlUserName = 'root';
$mysqlPassword = 'Avavav27';
$mysqlHostName = 'localhost';
$DbName = 'library';

function backUp($conn)
{
  $tables = array();
  $sql = "SHOW TABLES";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
  }

  $sqlScript = "";
  foreach ($tables as $table) {
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);

    $sqlScript .= "\n\n" . $row[1] . ";\n\n";
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    $columnCount = mysqli_num_fields($result);


    for ($i = 0; $i < $columnCount; $i++) {
      while ($row = mysqli_fetch_row($result)) {
        $sqlScript .= "INSERT INTO $table VALUES(";
        for ($j = 0; $j < $columnCount; $j++) {
          $row[$j] = $row[$j];

          if (isset($row[$j])) {
            $sqlScript .= '"' . $row[$j] . '"';
          } else {
            $sqlScript .= '""';
          }
          if ($j < ($columnCount - 1)) {
            $sqlScript .= ',';
          }
        }
        $sqlScript .= ");\n";
      }
    }
    $sqlScript .= "\n";
  }

  $database_name = "library";

  if (!empty($sqlScript)) {
    $backup_file_name = $database_name . '_backup_' . date('Y-m-d_H-i-s') . '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler);


    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);
    exec('rm ' . $backup_file_name);
  }

}



function restoreMysqlDB($filePath, $conn)
{
  
  $sql = '';
  $error = '';

  if (file_exists($filePath)) {
    $lines = file($filePath);

    foreach ($lines as $line) {
      if (substr($line, 0, 2) == '--' || $line == '') {
        continue;
      }
      $sql .= $line;
      if (substr(trim($line), -1, 1) == ';') {
        $result = mysqli_query($conn, $sql);
        if (!$result) {
          $error .= mysqli_error($conn) . "\n";
        }
        $sql = '';
      }
    if ($error) {
      echo ("<script>alert('error -> ''$error');</script>");
    } else {
      echo ("<script>alert('Success');</script>");
    }
  }
}
}


function checkFile($conn){
  if (! empty($_FILES)) {
    // Validating SQL file type by extensions
    if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
        "sql"
    ))) {
      echo ("<script>alert('Error invalid type');</script>");
    } else {
        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
            move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
            $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
        }
    }
}
}




if (isset($_POST['submit'])) {
  backUp($conn);
  //recoverData($conn);
}
if (isset($_POST['restore'])) {
  checkFile($conn);
  //recoverData($conn);
}
?>