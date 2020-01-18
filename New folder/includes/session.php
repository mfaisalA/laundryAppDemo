<?php 
	session_start();

  	if(!isset($_SESSION['workshop_id'])) {
  	  header('location: signin.php');
  	}

 ?>