<?php 

	require_once "../models/Session.php";
	
	$session = new Session();
	$session->destroySession();
	
	$redirect_url = "/login/?alert=logout-success";
	header('Location: ' .  $redirect_url);
	exit;
	
?>