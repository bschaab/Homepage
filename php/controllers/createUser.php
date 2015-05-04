<?php 

	require_once "../models/Session.php";
	require_once "../models/DatabaseCommunicator.php";
	require_once "../models/User.php";
	
	$session = new Session();
	$dbCom = new DatabaseCommunicator();
	$user = new User();

	//Redirect for fail missing params
	if ($_POST['firstName'] == "" || $_POST['lastName'] == "" || $_POST['email'] == "" || $_POST['password'] == "") {
		    
		$redirect_url = "/dash/?alert=create-missing";
		header('Location: ' .  $redirect_url);
		exit;
		    
	}

	//Set basics for user and save the user
	$user->setFirstName($_POST['firstName']);
	$user->setLastName($_POST['lastName']);
	$user->setEmail($_POST['email']);
	$user->setPassword($_POST['password']);
	$user->setQuickbarToDefault();
	$user->setWidgetsToDefault();
    $user->setBookmarksToDefault();
	$id = $user->saveUser();

	//Redirect for duplicate user creation fail
	if ($id < 1) {
		
		if ($id == -1) {
			$redirect_url = "/dash/?alert=create-duplicate";
			header('Location: ' .  $redirect_url);
			exit;
		}
		//Redirect for creation fail
		else {
			$redirect_url = "/dash/?alert=create-fail";
			header('Location: ' .  $redirect_url);
			exit;
		}
	}

	//Set session
	$session->setSessionVariable('userID', $id);

	//Redirect for success
	$redirect_url = "/dash/?alert=create-success";
	header('Location: ' .  $redirect_url);
	exit;
	
	
?>