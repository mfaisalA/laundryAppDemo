<?php 
	//require_once("session.php");

	define("APP_NAME", "Automated Vehicles Garage System");

	$localhost = "localhost";
	$username = "auto_garage";
	$password = "auto!@#";
	$database = "auto_garage_db";
	$con=mysqli_connect($localhost,$username,$password) or die('Database not connected');
	mysqli_select_db($con,$database) or die('Database not selected');

?>
