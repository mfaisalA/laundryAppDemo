<?php 
	//require_once("session.php");

	define("APP_NAME", "Automated Vehicles Garage System");

	$localhost = "localhost";
	$username = "root";
	$password = "";
	$database = "vehicle_management";
	$con=mysqli_connect($localhost,$username,$password) or die('Database not connected');
	mysqli_select_db($con,$database) or die('Database not selected');

?>
