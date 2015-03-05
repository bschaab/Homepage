<?php 

	require_once "../models/DatabaseCommunicator.php";
	
	//creates and sets up the database
	
	$dbCom = new DatabaseCommunicator();
	
	//redirect back home
	if ($dbCom->clean())  { $redirect_url = "/dash/?alert=dbsetup-success"; }
	else { $redirect_url = "/dash/?alert=dbsetup-fail"; }
	header('Location: ' .  $redirect_url);
	exit;
	
	
?>