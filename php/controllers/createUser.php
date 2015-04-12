<?php 

	require_once "../models/Session.php";
	require_once "../models/DatabaseCommunicator.php";
	require_once "../models/User.php";
	
	$session = new Session();
	$dbCom = new DatabaseCommunicator();
	$user = new User();
	
	if ($_POST['firstName'] == "" || $_POST['lastName'] == "" || $_POST['email'] == "" || $_POST['password'] == "") {
		    
		$redirect_url = "/dash/?alert=create-missing";
		header('Location: ' .  $redirect_url);
		exit;
		    
	}
	
	$user->setFirstName($_POST['firstName']);
	$user->setLastName($_POST['lastName']);
	$user->setEmail($_POST['email']);
	$user->setPassword($_POST['password']);
	$user->setQuickbarToDefault();
	$user->setWidgetsToDefault();
	$id = $user->saveUser();
	
	if ($id < 1) {
		
		if ($id == -1) {
			$redirect_url = "/dash/?alert=create-duplicate";
			header('Location: ' .  $redirect_url);
			exit;
		}
		else {
			$redirect_url = "/dash/?alert=create-fail";
			header('Location: ' .  $redirect_url);
			exit;
		}
	}
	
	$session->setSessionVariable('userID', $id);
	
	$redirect_url = "/dash/?alert=create-success";
	header('Location: ' .  $redirect_url);
	exit;
	
	
?>