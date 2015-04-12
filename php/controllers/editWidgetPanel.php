<?php 

	require_once "../models/Session.php";
	require_once "../models/DatabaseCommunicator.php";
	require_once "../models/User.php";
	
	$session = new Session();
	$dbCom = new DatabaseCommunicator();
	$user = new User();
	
	$userID = $session->getSessionVariable("userID");
	$user->loadUser($userID);
	
	$slot = $_POST["slot"];
	$widget = $_POST["widget"];
	$user->setWidget($slot, $widget);
	
	$status = $user->saveUser();
	
	if ($status < 1) {
		$redirect_url = "/dash/?alert=widget-edit-fail";
		header('Location: ' .  $redirect_url);
		exit;	
	}
	
	$redirect_url = "/dash/?alert=widget-edit-success";
	header('Location: ' .  $redirect_url);
	exit;
	
?>