<?php 

	require_once "../models/Session.php";
	require_once "../models/DatabaseCommunicator.php";
	require_once "../models/User.php";
	
	$session = new Session();
	$dbCom = new DatabaseCommunicator();
	$user = new User();

	//Load user based on session userID variable
	$userID = $session->getSessionVariable("userID");
	$user->loadUser($userID);

	//Set widget to the slot
	$slot = $_POST["slot"];
	$widget = $_POST["widget"];
	$user->setWidget($slot, $widget);

	//Save the user to save the widget
	$status = $user->saveUser();

	//Redirect on edit widget fail
	if ($status < 1) {
		$redirect_url = "/dash/?alert=widget-edit-fail";
		header('Location: ' .  $redirect_url);
		exit;	
	}

	//Redirect on edit widget success
	$redirect_url = "/dash/?alert=widget-edit-success";
	header('Location: ' .  $redirect_url);
	exit;
	
?>