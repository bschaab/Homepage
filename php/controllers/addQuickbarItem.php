<?php 

	require_once "../models/Session.php";
	require_once "../models/DatabaseCommunicator.php";
	require_once "../models/User.php";
	
	$session = new Session();
	$dbCom = new DatabaseCommunicator();
	$user = new User();
	
	$userID = $session->getSessionVariable("userID");
	$user->loadUser($userID);
	
	$title = $_POST['linkTitle'];
	$link = $_POST['link'];
	
	//check for valid input
	if ($title == "" || $link == "") {
		$redirect_url = "/dash/?alert=quickbar-add-invalid-input";
		header('Location: ' .  $redirect_url);
		exit;
	}
	if (strpos($link, "http://") === false) {
		$link = "http://" . $link;
	}
	
	//add them to the quickbar and save
	$user->addToQuickbar($title, $link);
	$status = $user->saveUser();
	
	if ($status < 1) {
		$redirect_url = "/dash/?alert=quickbar-add-fail";
		header('Location: ' .  $redirect_url);
		exit;	
	}
	
	$redirect_url = "/dash/?alert=quickbar-add-success";
	header('Location: ' .  $redirect_url);
	exit;
	
	
?>