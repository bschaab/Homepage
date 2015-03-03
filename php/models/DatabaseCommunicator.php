<?php
	
	
	/**
	* This class allows for communication with the database
	*/
	class DatabaseCommunicator {
		
		
		protected $user = 'root';
		protected $password = 'root';
		protected $name = 'homepageDB';
		protected $host = "127.0.0.1";
		protected $port = 8889;
		protected $connection = null;
		
		protected $result = null; //query result holder
	
		function __construct() {
			
			//open database connection
			$this->open();
			
			//if selection fails, setup the database
			if (!$this->select()) {
				if (!$this->setup()) {
					die("Database setup failed:" . mysql_error());
				}
			}
			
			//check that database was setup
			$result = mysql_query("SELECT * FROM users", $this->connection);
			$row = mysql_fetch_array($result);
			if ($row['id'] != 1) {
				die("Database setup check failed:" . mysql_error());
			}
			
			
		}
		
		
		function __destruct() {
			$this->close(); //close database connection
		}
		
		
		//open database connection
		protected function open() {
			$this->connection = mysql_connect($this->host, $this->user);
			if (!$this->connection) {
				die("Database connection failed:" . mysql_error());
			}
		}
		
		
		//close database connection
		protected function close() { 
			mysql_close($this->connection);
		}
		
		
		//select the database
		protected function select() {
			if (!mysql_select_db($this->name, $this->connection)) {
				return false;
			}
			return true;
		}
		
		
		//setup the database
		protected function setup() {
			
			$name = $this->name;
			
			//drop old database if exists
			$query = "DROP DATABASE $name";
			$this->runQuery($query);
			
			//create new database
			$query = "CREATE DATABASE $name";
			if (!$this->runQuery($query)) {
				return false;
			}
			
			//select our new database
			if (!$this->select()) { return false; }
			
			//create the users table
			$query = "CREATE TABLE users (
						id int(16) UNIQUE NOT NULL AUTO_INCREMENT,
						lastName varchar(255),
						firstName varchar(255),
						email varchar(255) UNIQUE,
						password varchar(512),
						PRIMARY KEY (id)
						);";
			if (!$this->runQuery($query)) {
				return false;
			}
			
			//create a sample user
			$password = password_hash("password", PASSWORD_DEFAULT);
			$query = "INSERT INTO users
						(lastName, firstName, email, password) VALUES
						('User', 'Sample', 'sample@email.com', '$password');";
			if (!$this->runQuery($query)) {
				return false;
			}
			
			return true;
			
		}
		
		
		
		//query the database
		public function runQuery($query) {
			if (!($this->result = mysql_query($query, $this->connection))) {
				return false;
			}
			return true;
		}
		
		public function getQueryResult() {
			if (!$this->result) { return null; }
			return mysql_fetch_array($this->result);
		}
		
		public function getNumOfQueryResults() {
			if (!$this->result) { return null; }
			return mysql_num_rows($this->result);
		}
		
	
	}
	






?>