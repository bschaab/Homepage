<?php 

	require_once "../models/Session.php";
	require_once "../models/DatabaseCommunicator.php";
	require_once "../models/User.php";
	
	$session = new Session();
	$dbCom = new DatabaseCommunicator();
	$user = new User();
	
	if ($_POST['firstName'] == "" || $_POST['lastName'] == "" || $_POST['email'] == "" || $_POST['password'] == "") {
		    
		$redirect_url = "/login/?alert=missing";
		header('Location: ' .  $redirect_url);
		exit;
		    
	}
	
	$user->setFirstName($_POST['firstName']);
	$user->setLastName($_POST['lastName']);
	$user->setEmail($_POST['email']);
	$user->setPassword($_POST['password']);
	$id = $user->saveUser();
	
	$session->setSessionVariable('userID', $id);
	
	$redirect_url = "/";
	header('Location: ' .  $redirect_url);
	exit;
	
	
?>