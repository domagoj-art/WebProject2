<?php
require("../Database/Connection.php");
require("../Class/PaginationClass.php");
require("../Class/LogsClass.php");
$statisticsPagination = new Pagination();
$table = "loginStatistics";
$resultPerPage = $statisticsPagination->resultPerPage($conn);
$pageNo = $statisticsPagination->pageNo();
$getPage = $statisticsPagination->getPage();
$prevPage = $statisticsPagination->prevPage($pageNo);
$totalPages = $statisticsPagination->getTotalPages($conn, $resultPerPage, $table);
$nextPage = $statisticsPagination->nextPage($pageNo, $totalPages);

function statisticsView($conn, $pageNo, $resultPerPage)
{

    $initialPage = $pageNo - 1;
    $results = $initialPage * $resultPerPage;
    $sql2 = "SELECT	* FROM loginstatistics 
             JOIN users ON loginstatistics.userId = users.id
            LIMIT " . $results . ", $resultPerPage";
    $result2 = $conn->query($sql2);
    echo "<table id='books'>";
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>UserID</th>';
    echo '<th>Name</th>';
    echo '<th>Lastname</th>';
    echo '<th>Login time</th>';
    echo '<th>Logout time</th>';
    echo '<th>User statistics</th>';
    echo '</tr>';
    while ($row = $result2->fetch_array()) {
        $id = $row['loginStatisticsId'];
        $userId = $row['userId'];
        $name = $row['name'];
        $lastname = $row['lastname'];
        $loginDate = $row['loginDate'];
        $logoutDate = $row['logoutDate'];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$userId</td>";
        echo "<td>$name</td>";
        echo "<td>$lastname</td>";
        echo "<td>$loginDate</td>";
        echo "<td>$logoutDate</td>";
        echo "<td><a href='?id=$userId'>Statistics</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    $result2->close();
}
statisticsView($conn, $pageNo, $resultPerPage);



function logedInTime($conn, $id)
{
    $logedinDate = 0;
    $sql = "SELECT	* FROM loginstatistics WHERE userId = $id AND logoutDate != 0";
    $result2 = $conn->query($sql);
    while ($row = $result2->fetch_array()) {
        $loginDate = $row['loginDate'];
        $logoutDate = $row['logoutDate'];
        $loginStamp = strtotime($loginDate);
        $logoutStamp = strtotime(($logoutDate));
        global $logedinDate;
        $temp = $logoutStamp - $loginStamp;
        $logedinDate = $logedinDate + $temp;

    }
    
 
    return $logedinDate / 60;
}


function numberOfRentedBooks($conn, $id){
    $sql = "SELECT count(*) as total from archive WHERE userId = $id";
    $result = mysqli_query($conn, $sql);
    $data=mysqli_fetch_assoc($result);
    //echo $data['total'];
    return $data['total'];

}

function numberOfReturnedBooks($conn, $id){
    $sql = "SELECT count(*) as total from archive WHERE userId = $id AND returnDate = 0";
    $result = mysqli_query($conn, $sql);
    $data=mysqli_fetch_assoc($result);
    //echo $data['total'];
    return $data['total'];
}

function logsEntry($conn, $id){
    $sql = "SELECT count(*) as total from logs WHERE userId = $id";
    $result = mysqli_query($conn, $sql);
    $data=mysqli_fetch_assoc($result);
    //echo $data['total'];
    return $data['total'];
}

function fromDateLogs($conn, $fromDate, $toDate, $id){
    $sql = "SELECT count(*) as total FROM logins WHERE userId = $id AND time >= $fromDate AND time <= $toDate";
    $result = mysqli_query($conn, $sql);
    $data=mysqli_fetch_assoc($result);
    return $data['total'];
}
function fromDate($conn, $fromDate, $toDate, $id){
    $sql = "SELECT count(*) as total FROM logs WHERE userId = $id AND time >= $fromDate AND time <= $toDate";
    $result = mysqli_query($conn, $sql);
    $data=mysqli_fetch_assoc($result);
    return $data['total'];
}

?>