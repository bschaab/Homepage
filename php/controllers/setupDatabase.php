<?php 

	require_once "../models/DatabaseCommunicator.php";
	
	//creates and sets up the database
	$dbCom = new DatabaseCommunicator();
	
	//redirect back home
	$redirect_url = "/";
	header('Location: ' .  $redirect_url);
	exit;
	
	
?>