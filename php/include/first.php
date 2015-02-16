<?php 
	
	//keep sessions alive for 2 weeks
	ini_set('session.gc_maxlifetime', 3600 * 24 * 7 * 2);
	ini_set('session.cookie_lifetime', 3600 * 24 * 7 * 2);
	session_start();
	
	if (!isset($_SESSION['userID'])) {
		header('Location: /login');
		exit;
	}
	
	date_default_timezone_set('America/Chicago');
	$noCache = time(); 
	
?>