<?php 
	
	/**
	*  This objects represent a session of the homepage service
	*/
	class Session {
		
		function __construct() {
			
			//keep sessions alive for 2 weeks
			ini_set('session.gc_maxlifetime', 3600 * 24 * 7 * 2);
			ini_set('session.cookie_lifetime', 3600 * 24 * 7 * 2);
			session_start();
		}
		
		/**
			* setSessionVariable saves a key-value pair in the session
			* @param $key the key of the key-value pair as a string
			* @param $value the value of the key-value pair as a primitive type
	 	*/
		function setSessionVariable($key, $value) {
			$_SESSION[$key] = $value;
		}
		
		/**
			* getSessionVariable retrieves the value associated with the given key in the session
			* @param $key the key of the key-value pair as a string 
			* @return the value associated with $key in the session
	 	*/
		function getSessionVariable($key) {
			return $_SESSION[$key];
		}
		
		/**
			* destroySession kills the session for logging out
	 	*/
		function destroySession() {
			session_unset();
			session_destroy();
			session_write_close();
			setcookie(session_name(),'',0,'/');
			session_regenerate_id(true);
		}
		
	
	}
	
?>