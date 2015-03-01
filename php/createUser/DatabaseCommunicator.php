<?php
	
	
	/**
	* This class allows for communication with the database
	*/
	class DatabaseCommunicator {
		
		
		protected $user = 'root';
		protected $password = 'root';
		protected $name = 'homepageDB';
		protected $host = 'localhost';
		protected $port = 8889;
		protected $connection = null;
		
	
		function __construct() {
			
			//open database connection
			open();
			
			//if selection fails, setup the database
			if (!select()) {
				if (!setup()) {
					die("Database setup failed:" . mysql_error());
				}
			}
			
			
		}
		
		
		function __destruct() {
			close(); //close database connection
		}
		
		
		//open database connection
		protected function open() {
			$connection = mysql_connect($host, $user, $password);
			if (!$connection) {
				die("Database connected failed:" . mysql_error());
			}
			$this->connection = $connection;
		}
		
		
		//close database connection
		protected function close() { 
			$connection = mysql_connect($host, $user, $password);
			if (!$connection) {
				die("Database connected failed:" . mysql_error());
			}
			$this->connection = $connection;
		}
		
		
		//select the database
		protected function select() {
			if (!mysql_select_db($name, $connection)) {
				return false;
			}
			return true;
		}
		
		
		//setup the database
		protected function setup() {
			
			//drop old database if exists
			$query = "DROP DATABASE $dbName";
			query($query);
			
			//create new database
			$query = "CREATE DATABASE $dbName";
			if (!query($query)) {
				return false;
			}
			
			//select our new database
			if (!select()) { return false; }
			
			//create the users table
			$query = "CREATE TABLE users (
						id int(16) UNIQUE NOT NULL AUTO_INCREMENT,
						lastName varchar(255),
						firstName varchar(255),
						email varchar(255) UNIQUE,
						password varchar(512),
						PRIMARY KEY (id)
						);";
			if (!query($query)) {
				return false;
			}
			
			//create a sample user
			$password = password_hash("password", PASSWORD_DEFAULT);
			$query = "INSERT INTO users
						(lastName, firstName, email, password) VALUES
						('User', 'Sample', 'sample@email.com', '$password');";
			if (!query($query)) {
				return false;
			}
			
			return true;
			
		}
		
		
		
		//query the database
		public function query($query) {
			if (!mysql_query($query, $connection)) {
				return false;
			}
			return true;
		}
		
		
	
	}
	






?>