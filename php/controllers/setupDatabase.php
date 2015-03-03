<?php 

	require_once "../models/DatabaseCommunicator.php";
	
	//creates and sets up the database
	
	$dbCom = new DatabaseCommunicator();
	
	//redirect back home
	if ($dbCom->clean())  { $redirect_url = "/login/?alert=dbsetup-success"; }
	else { $redirect_url = "/login/?alert=dbsetup-fail"; }
	header('Location: ' .  $redirect_url);
	exit;
	
	
?>