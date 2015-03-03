<?php 
	
	require_once "DatabaseCommunicator.php";
	
	/**
	* Manages a User
	*/
	class User {
		
		protected $id;
		protected $firstName;
		protected $lastName;
		protected $email;
		protected $hashedPassword;
		
		
		function __construct() {
			
		}
		
		function getId() {
			return $this->id;
		}
		
		function getFirstName() {
			return $this->firstName;
		}
		
		function getLastName() {
			return $this->lastName;
		}
		
		function getEmail() {
			return $this->email;
		}
		
		function getPassword() {
			return $this->hashedPassword;
		}
		
		
		function setId($id) {
			$this->id = $id;
		}
		
		function setFirstName($firstName) {
			$this->firstName = $firstName;
		}
		
		function setLastName($lastName) {
			$this->lastName = $lastName;
		}
		
		function setEmail($email) {
			$this->email = $email;
		}
		
		function setPassword($password) {
			$this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		}
		
		
		function loadUser($id) {
			$dbCom = new DatabaseCommunicator();
	
			$query = "SELECT * FROM users WHERE id = $id";
	
	        if (!$dbCom->runQuery($query)) { return false; }
	        if (!$result = $dbCom->getQueryResult()) { return false; }
	        $this->id = $result['id'];
	        $this->firstName = $result['firstName'];
	        $this->lastName = $result['lastName'];
	        $this->email = $result['email'];
	        $this->hashedPassword = $result['password'];
	        
	        return true;
		}
		
		function saveUser() {
			$dbCom = new DatabaseCommunicator();
			
			$firstName = $this->firstName;
			$lastName = $this->lastName;
			$email = $this->email;
			$hashedPassword = $this->hashedPassword;
	
			$query = "INSERT INTO users
						(lastName, firstName, email, password) VALUES
						('$lastName', '$firstName', '$email', '$hashedPassword');";
	
	        if (!$dbCom->runQuery($query)) { return false; }
	        
	        $query = "SELECT * FROM users WHERE id = $id";
	        if (!$dbCom->runQuery($query)) { return false; }
	        if (!$result = $dbCom->getQueryResult()) { return false; }
	        return $result['id'];
	        
		}
		
		
		// verifies a user by their email and password
		// returns their id or false
		function verifyUser($rawPassword) {
			
			$dbCom = new DatabaseCommunicator();
			
			$email = strtolower($this->email);
			$query = "SELECT * FROM users WHERE lower(email)='$email' LIMIT 1";
			if (!$dbCom->runQuery($query)) { return false; }
	        if (!$result = $dbCom->getQueryResult()) { return false; }
			
			//if no rows returned, return false
			$numOfRows = $dbCom->getNumOfQueryResults();
			if ($numOfRows == 0) {
				return false;
			}
			
			//if password matches, return the id
			$hashedPassword = $result['password'];
			if (password_verify($rawPassword, $hashedPassword)) {
				
				//rehash the password if it needs rehashing
				if (password_needs_rehash($hashedPassword, PASSWORD_DEFAULT)) {
					$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);
					$query = "UPDATE users SET password = '$hashedPassword' WHERE lower(email)='$email'";
					if (!$dbCom->runQuery($query)) { return false; }
				}
				
				
				return htmlentities($result['id']);
			}
			
			return false;
			
		}
		
	
	}
	
?>