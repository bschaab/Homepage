<?php 

	require_once "../models/Session.php";

	//Destroy session to logout
	$session = new Session();
	$session->destroySession();

	//Redirect on logout success
	$redirect_url = "/dash/?alert=logout-success";
	header('Location: ' .  $redirect_url);
	exit;
	
?>