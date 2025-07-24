<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php ");
exit(); }
require('db.php');
$a=$_SESSION['username'];
$sql="SELECT * FROM `users` where `username`='$a'";
$result2 = mysqli_query($con,$sql); // selecting data through mysql_query()
$data2 = mysqli_fetch_array($result2);
?>

