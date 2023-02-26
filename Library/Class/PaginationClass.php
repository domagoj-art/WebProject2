<?php
class Pagination{
    public function pageNo(){
        if (!isset($_GET['pageNo'])) {
    
            $pageNo = 1;
            return $pageNo;
    
        } else {
    
            $pageNo = $_GET['pageNo'];
            return $pageNo;
        }
    }
    public function getPage()
    {
        if (!isset($_GET['pageNo'])) {
            return 1;
        } else {
            return $_REQUEST['pageNo'];
        }
    }
    public function nextPage($pageNo, $totalPages)
    {
        if (($pageNo + 1) <= $totalPages) {
            return ($pageNo + 1);
        } else {
            return "";
        }
    }
    public function prevPage($pageNo)
    {
        if ($pageNo == 1) {
            return "";
        } else {
            return ($pageNo - 1);
        }
    }
    public function resultPerPage($conn){
        $sql = "SELECT * FROM config ";
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            $fetch = mysqli_fetch_assoc($result);
            $resultPerPage = $fetch['pagination'];
            return $resultPerPage;
        }
    }
    
    public function getTotalPages($conn, $resultPerPage, $table)
    {
    
        $sql3 = "SELECT * FROM $table";
        $result3 = mysqli_query($conn, $sql3);
        $totalRows = mysqli_num_rows($result3);
        $totalPages = ceil($totalRows / $resultPerPage);
        return $totalPages;
    }
}
?>