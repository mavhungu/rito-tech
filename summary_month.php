<?php
require_once 'functions.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Summary based on the month</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/app.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <a class="navbar-brand" href="index.php">MAVHUNGU RONEWA</a>
  </nav>
  <div class="container-fluid">
        <div class="row justify-content-center mt-3">
        <div class="col-lg-6 col-sm-12">
<?php

if(isset($_GET['view'])){

    global $con;

    $id = $_GET['view'];

     echo '<h3 class="text-center">'.$id.'</h3>';
     echo '<div class="table-responsive-sm">
     <table class="table table-dark table-striped table-bordered table-sm">
        <thead class="table-info">
            <tr class="text-center">
                <th>Extension</th>
                <th>No.Calls</th>
                <th>Total Cost</th>
            </tr>
        </thead>
        <tbody>';

    foreach($con->query("SELECT CallFrom, COUNT(CallTo) AS No_Calls, SUM(Cost) AS Total_Cost FROM bvscalls WHERE CallTime LIKE '$id%' GROUP BY CallFrom") as $row){
        $CallFrom = $row['CallFrom'];
        
        echo "<tr class='text-center'>";
        echo "<td><a class='links' href='list_all_calls.php?view=$CallFrom&date=$id'>" . $row['CallFrom'] . "</a></td>";
        echo "<td>" . $row['No_Calls'] . "</td>";
        echo "<td>" . $row['Total_Cost'] . "</td>";
        
        echo "</tr>";
    }
}
echo '</tbody>
        </table>
        </div>';
?>

</div>
</div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>