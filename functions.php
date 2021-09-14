<?php

require_once 'info.php';
session_start();
date_default_timezone_set('Africa/Harare');
ob_start();


function UsersName(){

    global $con;
    $year = 2018;

    foreach($con->query("SELECT DATE_FORMAT(CallTime,'%Y-%m') month, COUNT(CallTo) AS No_Calls, SUM(Cost) AS Total_Cost FROM bvscalls WHERE YEAR(CallTime) = $year GROUP BY month") as $row){
        $month = $row['month'];
        $months[] = $row['month'];
        $total_Cost[] = $row['Total_Cost'];

        echo "<tr>";
        echo "<td><a class='list-unstyled' href='summary_month.php?view=$month'>" . $row['month'] . "</a></td>";
        echo "<td>" . $row['No_Calls'] . "</td>";
        echo "<td>" . $row['Total_Cost'] . "</td>";
        echo "</tr>";
        }
}
    ?>