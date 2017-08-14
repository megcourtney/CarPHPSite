<?php
session_start();

$con = mysqli_connect('localhost','root','root', 'mysql');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


$carID = $_POST['carID']; //gets carID from AJAX
$sql = "UPDATE rental SET status = 2, returnDate = CURDATE() WHERE carID = '".$carID."' order BY ID DESC LIMIT 1;";//gets the last rental of the car to return
$sql2 = "UPDATE car SET status = 1 WHERE ID = '".$carID."';";   //sets the car status to 1 so it may be rented again

$result = mysqli_query($con,$sql);  //executes SQL
$result2 = mysqli_query($con,$sql2);

mysqli_close($con);