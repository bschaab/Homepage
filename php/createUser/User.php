<?php 
	
	require_once "DatabaseCommunicator.php";
	
	/**
	* Manages a User
	*/
	class User {
		
		protected $firstName;
		protected $lastName;
		protected $email;
		protected $hashedPassword;
		
		
		function __construct() {
			
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
	
	        if (!$dbCom->runQuery()) { return false; }
	        if (!$result = $dbCom->getQueryResult($query)) {
		        return false;
	        }
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
	        return true;
		}
		
	
	}
	
?>