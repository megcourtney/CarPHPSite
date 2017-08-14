<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$con = mysqli_connect('localhost','root','root', 'mysql');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
} 

$sql= "SELECT rental.*, carspecs.Make, carspecs.Model, carspecs.Year, carspecs.Size, car.Color,
        car.picture, car.picture_type 
        FROM rental 
        JOIN car
        ON car.ID = rental.carID
        JOIN carspecs
        ON car.CarSpecsID = carspecs.ID
        WHERE rental.status = 2 AND rental.CustomerID = '".$_SESSION['customerID']."'"; //gets rental history of the customer

$result = mysqli_query($con,$sql);
$row_count = mysqli_num_rows($result);

$html = "<table>";
$html.= "<tr>";
$html.=     "<th> Picture </th> <th> Details </th> <th> </th>";
$html.= "</tr>";

if ($row_count < 1) {
    $html="<p> You haven't returned any cars. </p>";
}
else {
    for ($j = 0; $j < $row_count; ++$j) {
        $row = mysqli_fetch_array($result); //fetch the next row
        
        $html.= "<tr>";
        $html.=     "<td>". '<img src="data:' . $row["picture_type"] . ';base64,' . base64_encode($row["picture"]) . '">' . "</td>";
        $html.=     "<td class = 'car_details'>";
        $html.=         "<div class='car_title'>";
        $html.=             "<div class='car_make'>" . $row["Make"] . " | " . $row["Model"] . "</div>";
        $html.=             "<div class='car_year'> ". $row["Year"] . "</div>";
        $html.=         "</div>";
        $html.=         "<div class='car_size'> Size: " . $row["Size"] . "</div>";
        $html.=         "<div class='rental_ID'> Rental #: " . $row["ID"] . "</div>";
        $html.=         "<div class='car_date'> Return Date: " . $row["returnDate"] . "</div>";
        $html.=     "</td>";
        $html.= "</tr>";    //adds this html for every car in the results of sql statement

    }
    $html.="</table>";
}
    
echo $html; //returns this to the AJAX

mysqli_close($con);