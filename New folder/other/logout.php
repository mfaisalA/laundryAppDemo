<?php 
	require_once('includes/session.php');
	$_SESSION['workshop_id'] = null;

	header('location: index.php')
?>