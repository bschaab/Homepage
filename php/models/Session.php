<?php 
	
	/**
	* Manages a Session
	*/
	class Session {
		
		function __construct() {
			
			//keep sessions alive for 2 weeks
			ini_set('session.gc_maxlifetime', 3600 * 24 * 7 * 2);
			ini_set('session.cookie_lifetime', 3600 * 24 * 7 * 2);
			session_start();
		}
		
		
		function setSessionVariable($key, $value) {
			$_SESSION[$key] = $value;
		}
		
		function getSessionVariable($key) {
			return $_SESSION[$key];
		}
		
		function destroySession() {
			session_unset();
			session_destroy();
			session_write_close();
			setcookie(session_name(),'',0,'/');
			session_regenerate_id(true);
		}
		
	
	}
	
?>