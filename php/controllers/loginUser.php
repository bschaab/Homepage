<?php 

	require_once "../models/Session.php";
	require_once "../models/DatabaseCommunicator.php";
	require_once "../models/User.php";
	
	$session = new Session();
	$dbCom = new DatabaseCommunicator();
	$user = new User();
	
	
	//log in handler
	if (!$session->getSessionVariable('userID')) { //if we have NOT logged in yet
		
		//set email & password
		if (isset($_POST['email'])) { $email = strtolower($_POST['email']); }
		else { $email = ""; }
		if (isset($_POST['password'])) { $password = $_POST['password']; }
		else { $password = ""; }
		
		//set user's credentials
		$user->setEmail($email);
		
		//attempt to verify user's credentials
		if ($id = $user->verifyUser($password)) {
			$session->setSessionVariable('userID', $id);
		}
		
	}
	
	
	//redirect to destination
	if (!$session->getSessionVariable('userID')) {
		$redirect_url = "/login/?alert=fail";
	}
	else {
		$redirect_url = "/";
	}
	
	header('Location: ' .  $redirect_url);
	exit;
	
	
?>
	
	
?>