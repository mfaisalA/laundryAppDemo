<?php 
	require_once('includes/session.php');
	$_SESSION['admin_id'] = null;

	header('location: index.php')
?>