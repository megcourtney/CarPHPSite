<?php
$username = $_POST['name']; //gets username and pw from AJAX
$password = md5($_POST['password']);

$con = mysqli_connect('localhost','root','root', 'mysql');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM customer WHERE ID = '".$username."' AND Password = '".$password."'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

if($row['Name'] != null){
    session_start();    //starts a session
    $_SESSION['fullname'] = (string)$row['Name'];   //sets session vars for the full name of user and id of user
    $_SESSION['customerID'] = (string)$row['ID'];
    echo ($_SESSION['fullname']);   //returns fullname if it is a valid user
}
else{
    echo (0); //returns 0 if not a valid user
}

?>