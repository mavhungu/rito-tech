<?php
require_once 'info.php';
global $con;
$year = 2018;

foreach($con->query("SELECT DATE_FORMAT(CallTime,'%Y-%m') month, COUNT(CallTo) AS No_Calls, SUM(Cost) AS Total_Cost FROM bvscalls WHERE YEAR(CallTime) = $year GROUP BY month") as $row){
    $month = $row['month'];

    $months[] = $row['month'];
    $no_Calls[] = $row['No_Calls'];
    $total_Cost[] = $row['Total_Cost'];
}
function UsersName(){

    global $con;
    $year = 2018;

    foreach($con->query("SELECT DATE_FORMAT(CallTime,'%Y-%m') month, COUNT(CallTo) AS No_Calls, SUM(Cost) AS Total_Cost FROM bvscalls WHERE YEAR(CallTime) = $year GROUP BY month") as $row){
        $month = $row['month'];

        echo "<tr>";
        echo "<td><a class='list-unstyled' href='summary_month.php?view=$month'>" . $row['month'] . "</a></td>";
        echo "<td>" . $row['No_Calls'] . "</td>";
        echo "<td>" . $row['Total_Cost'] . "</td>";
        echo "</tr>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center mt-3">
        <div class="col-lg-6 col-sm-12">
            <div style="hieght:20%;text-align:center">
                <h2 class="page-header" >Analytics Reports </h2>
                <div>Product </div>
                <canvas  id="chartjs_bar"></canvas>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-6 col-sm-12">
            <div class="table-responsive-sm">
                <table class="table table-dark table-striped table-bordered table-hover table-sm">
                    <thead class="table-info text-center">
                    <tr>
                        <th>Year - month</th>
                        <th>No.calls</th>
                        <th>Tottal Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    UsersName();
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
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:<?php echo json_encode($no_Calls); ?>,
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
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',

                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            },


        }
    });
</script>
</body>
</html>