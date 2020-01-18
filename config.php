<?php 
	//ADMIN CONFIG FILE

	define("APP_NAME", "e-Laundry System");

	$localhost = "localhost";
	$username = "root";
	$password = "";
	$database = "e_laundry_db";
	$con=mysqli_connect($localhost,$username,$password) or die('Database not connected');
	mysqli_select_db($con,$database) or die('Database not selected');

?>
