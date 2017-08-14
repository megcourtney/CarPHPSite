<?php
session_start();

$con = mysqli_connect('localhost','root','root', 'mysql');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
 
 
$carID = $_POST['carID'];   //gets carId from AJAX

$sql = "INSERT INTO rental (rentDate, returnDate, status, CustomerID, carID) VALUES
(CURDATE(), NULL, 1, '".$_SESSION['customerID']."', '".$carID."');";    //adds a new rental entry for the car

$sql2 = "UPDATE car SET status = 2 WHERE ID = '".$carID."';";   //updates the car status to 2 so it can't be rented again


$result = mysqli_query($con,$sql);  //executes sql
$result2 = mysqli_query($con,$sql2);



mysqli_close($con);