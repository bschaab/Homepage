<?php  
	
	//keep sessions alive for 2 weeks
	ini_set('session.gc_maxlifetime', 3600 * 24 * 7 * 2);
	ini_set('session.cookie_lifetime', 3600 * 24 * 7 * 2);
	session_start();
	
	//totally clear session
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    
	header('Location: /');
	exit;
	
?>