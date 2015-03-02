<?php 

	require_once "../models/Session.php";
	
	$session = new Session();
	$session->destroySession();
	
	$redirect_url = "/";
	header('Location: ' .  $redirect_url);
	exit;
	
?>