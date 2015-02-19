<?php 
	
	require 'testingFunctions.php';
	
	
	
	
	
	
	/* log us out in prep for test */
	
	openURL($documentRoot . "/php/scripts/logout.php");
	
	
	
	
	/* TEST a valid log in */
	
	$credentials = array(
		'email' => urlencode("sample@email.com"),
		'password' => urlencode("password")
	);
	
	
	
	$result = postURL($documentRoot . "/php/scripts/login.php", $credentials);
	
	assertNotContains("Check Valid Login", $result, "Login Failed");
	
	
	
	/* TEST a invalid log in */
	
	$credentials = array(
		'email' => urlencode("bill@email.com"),
		'password' => urlencode("wrongpassword")
	);
	
	$result = postURL($documentRoot . "/php/scripts/login.php", $credentials);
	
	assertContains("Check Invalid Login", $result, "Login Failed");
	
	
	/* TEST no password invalid log in */
	
	$credentials = array(
		'email' => urlencode("sample@email.com"),
		'password' => urlencode("")
	);
	
	$result = postURL($documentRoot . "/php/scripts/login.php", $credentials);
	
	assertContains("Check No Password Invalid Login", $result, "Login Failed");
	
	
	
	/* TEST no email invalid log in */
	
	$credentials = array(
		'email' => urlencode(""),
		'password' => urlencode("password")
	);
	
	$result = postURL($documentRoot . "/php/scripts/login.php", $credentials);
	
	assertContains("Check No Email Invalid Login", $result, "Login Failed");
	
	
	
	
	
	
	
?>