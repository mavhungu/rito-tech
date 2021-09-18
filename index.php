<?php
require_once 'connect/info.php';
global $con;
$year = 2018;

foreach($con->query("SELECT DATE_FORMAT(CallTime,'%Y-%m') month, COUNT(CallTo) AS No_Calls, SUM(Cost) AS Total_Cost FROM bvscalls WHERE YEAR(CallTime) = $year GROUP BY month") as $row){
    $month = $row['month'];

    $months[] = $row['month'];
    $no_Calls[] = $row['No_Calls'];
    $total_Cost[] = $row['Total_Cost'];
}
function tableData(){

    global $con;
    $year = 2018;

    foreach($con->query("SELECT DATE_FORMAT(CallTime,'%Y-%m') month, COUNT(CallTo) AS No_Calls, SUM(Cost) AS Total_Cost FROM bvscalls WHERE YEAR(CallTime) = $year GROUP BY month") as $row){
        $month = $row['month'];

        echo "<tr>";
        echo "<td><a class='links' href='files/summary_month.php?view=$month'>" . $row['month'] . "</a></td>";
        echo "<td>" . $row['No_Calls'] . "</td>";
        echo "<td>" . $row['Total_Cost'] . "</td>";
        echo "</tr>";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Rito tech Asg</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <!--link rel="icon" href="assets/images/favicon.ico"-->
    <link rel="icon" href="assets/img/ronewa.svg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/app.css">
  </head>
  <body>
      <nav class="navbar navbar-expand-sm navbar-light bg-light">
          <a class="navbar-brand" href="index.php">
              <img src="assets/img/ronewa.svg" class="rounded-circle img-fluid img-resonsive img-thumbnail" style="width: 40px !important;">
          </a>
      </nav>
  <div class="container-fluid">
      <div class="row justify-content-center mt-3">
          <div class="col-lg-8 col-sm-12">
              <div class="graph">
                  <canvas  id="chartjs_bar"></canvas>
              </div>
          </div>
      </div>
      <div class="row justify-content-center mt-3">
          <div class="col-lg-8 col-sm-12">
              <div class="table-responsive-sm">
                  <table class="table table-dark table-striped table-bordered table-hover table-sm">
                      <thead class="table-info text-center">
                          <tr>
                              <th>Year - Month</th>
                              <th>No.calls</th>
                              <th>Tottal Cost</th>
                          </tr>
                      </thead>
                          <tbody>
                              <?php
                                tableData();
                              ?>
                          </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	
	<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
        var barGraph = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:<?php echo json_encode($months); ?>,
                datasets: [{
                    backgroundColor: [
                       "#5969ff",
                        "#ff407b",
                        "#25d5f2",
                        "#ffc750",
                        "#2ec551",
                        "#7040fa",
                        "#ff004e"
                    ],
                    data:<?php echo json_encode($total_Cost); ?>,
                    label: 'Total cost',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Bar Chart'
                    }
                }
            }
        });
    </script>
  </body>
</html>