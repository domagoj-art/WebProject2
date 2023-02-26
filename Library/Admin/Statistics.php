
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

<?php
$title = "Statistics";
require_once("../Templates/AdminHeader.php");
require_once("StatisticsFunctions.php");
?>

<div class="responsiveContainer">
<div class="pages">
    <span class="Previous" >Previous page</span>
    <a href="?pageNo=<?= max(($pageNo - 1), 1) ?>">
        <?php echo $prevPage; ?>
    </a>
    <span class="current">
        <?php echo $getPage; ?>
    </span>
    <a href="?pageNo=<?= min(($pageNo + 1), $totalPages) ?>">
        <?php echo $nextPage; ?>
    </a>

    <span class="next" >next page</span>
    </div>

    
    <div id="piechart" style="width: 900px; height: 500px;"></div>


    


<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $books = numberOfRentedBooks($conn, $id);
    $timeIn = logedInTime($conn, $id);
    $returnedBooks = numberOfReturnedBooks($conn, $id);
    $logs = logsEntry($conn, $id);

    
    echo ("<script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['User', 'Activity'],
        
        ['Loged in Time in minutes',     '".$timeIn."'],
        ['Rented books',      '".$books."'],
        ['changes in db',  '".$logs."'],
        ['Returned books',  '".$returnedBooks."']
      
      ]);

      var options = {
        title: 'User statistic'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>");


  
}
?>

    <?php
    require_once("../Templates/AdminFooter.php");
    ?>