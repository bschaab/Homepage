<?php 
	
	//keep sessions alive for 2 weeks
	ini_set('session.gc_maxlifetime', 3600 * 24 * 7 * 2);
	ini_set('session.cookie_lifetime', 3600 * 24 * 7 * 2);
	session_start();
	
	date_default_timezone_set('America/Chicago');
	$noCache = time(); 
	
	
	//open database connection
	require($_SERVER['DOCUMENT_ROOT'] . "/php/db/open.php");
	
	
	//log in handler
	if (!isset($_SESSION['userID'])) { //if we have NOT logged in yet
		
		//set email & password
		if (isset($_POST['email'])) { $email = strtolower($_POST['email']); }
		else { $email = ""; }
		if (isset($_POST['password'])) { $password = $_POST['password']; }
		else { $password = ""; }
		
		//try to log in
		$loginResult = attemptLogin($email, $password, $connection);
		
		if ($loginResult != false) {
			$_SESSION['userID'] = $loginResult;
		}
		
	}
	
	//close database connection
	require($_SERVER['DOCUMENT_ROOT'] . "/php/db/close.php");
	
	
	//redirect to destination
	if (!isset($_SESSION['userID'])) {
		$redirect_url = "/login/?alert=fail";
	}
	else {
		$redirect_url = "/";
	}
	
	header('Location: ' .  $redirect_url);
	exit;
	
	
	
	/****FUNCTIONS****/
	
	/* attempts to login the member. returns the member id if true, returns false otherwise */
	function attemptLogin ($email, $password, $connection) {
		
		$email = strtolower($email);
	
		$query = "SELECT * FROM users WHERE lower(email)='$email' LIMIT 1";
		$result = mysql_query($query, $connection);
		$row = mysql_fetch_array($result);
		
		//if no rows returned, return false
		$numOfRows = mysql_num_rows($result);
		if ($numOfRows == 0) {
			return false;
		}
		
		//if password matches, return the id
		$hashed_password = $row['password'];
		if (password_verify($password, $hashed_password)) {
			
			//rehash the password if it needs rehashing
			if (password_needs_rehash($hashed_password, PASSWORD_DEFAULT)) {
				$rehashed_password = password_hash($password, PASSWORD_DEFAULT);
				$query = "UPDATE users SET password = '$hashed_password' WHERE lower(email)='$email'";
			}
			
			
			return htmlentities($row['id']);
		}
		
	}
	
	
?>
	
	
?>