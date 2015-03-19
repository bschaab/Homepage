<?php

/**
 * This class allows for communication with the database
 */
class DatabaseCommunicator {


	protected $user = 'root';
	protected $name = 'homepageDB';
	protected $host = "127.0.0.1";
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

		//create the quickbar table
		$query = "CREATE TABLE quickbar (
                  id int(16) UNIQUE NOT NULL AUTO_INCREMENT,
                  userID int(16),
                  title varchar(255),
                  link varchar(255),
                  icon varchar(255),
                  orderIndex int(4),
                  PRIMARY KEY (id)
                  );";
		if (!$this->runQuery($query)) {
			return false;
		}

		//create the twitter table
		$query = "CREATE TABLE twitter (
                  id int(16) UNIQUE NOT NULL AUTO_INCREMENT,
                  userID int(16),
                  oauthToken varchar(255),
                  oauthTokenSecret varchar(255),
                  username varchar(255),
                  PRIMARY KEY (id)
                  );";
		if (!$this->runQuery($query)) {
			return false;
		}

        //create instagram table for tokens
        $query = "CREATE TABLE instagram (
                  userID int(16) UNIQUE NOT NULL,
                  token varchar(255),
                  instagramID varchar(255),
                  PRIMARY KEY (userID)
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

		//add the sample user's quickbar
		$query = "INSERT INTO quickbar
                  (userID, title, link, icon, orderIndex) VALUES
                  (1, 'Twitter', 'http://twitter.com', 'http://grabicon.com/icon?size=50&origin=1196028656.com&domain=http://twitter.com', 0),
                  (1, 'Facebook', 'http://facebook.com', 'http://grabicon.com/icon?size=50&origin=1196028656.com&domain=http://facebook.com', 1),
                  (1, 'Youtube', 'http://youtube.com', 'http://grabicon.com/icon?size=50&origin=1196028656.com&domain=http://youtube.com', 2);";
		if (!$this->runQuery($query)) {
			return false;
		}

		//add the sample user's quickbar
		$query = "INSERT INTO twitter
                  (userID, oauthToken, oauthTokenSecret, username) VALUES
                  (1, '3031713874-GTxZJAegriyiuu9Xy49mcHnmGshSoU3rwStT6Vk', '6A78bk1hGjDAychFw4wbM2DZJ8TLNKzBPYD3YbDrUmrEc', 'throwawayacat');";
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


	//clean the database
	public function clean() {
		if (!$this->setup()) {
			return false;
		}
		if (!$this->select()) {
			return false;
		}
		return true;
	}


}







?>