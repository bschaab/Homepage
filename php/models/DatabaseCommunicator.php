<?php
	
require_once "Session.php";

/**
 * This class allows for communication with the database
 */
class DatabaseCommunicator {


	protected $user = 'root';
	protected $password = 'root';
	protected $name = 'homepageDB';
	//protected $host = "localhost";
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
		//$this->connection = mysql_connect($this->host, $this->user, $this->password);
		$this->connection = mysql_connect($this->host, $this->user);
		if (!$this->connection) {
			die("Database connection failed:" . mysql_error());
		}
	}


	//close database connection
	protected function close() {
		//mysql_close($this->connection);
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
		
		//clear current session
		$session = new Session();
		$session->destroySession();
		

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


		$this->setupTables();

		$this->setupSampleUser();
        

		return true;

	}
	
	
	
	//setup the tables
	//called by setup()
	public function setupTables() {
		
		//create the users table
		$query = "CREATE TABLE users (
                  id int(16) UNIQUE NOT NULL AUTO_INCREMENT,
                  lastName varchar(255),
                  firstName varchar(255),
                  email varchar(255) UNIQUE,
                  password varchar(512),
                  widget0 varchar(64),
                  widget1 varchar(64),
                  widget2 varchar(64),
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

        //create the bookmarks table
        $query = "CREATE TABLE bookmarks (
                  id int(16) UNIQUE NOT NULL AUTO_INCREMENT,
                  userID int(16),
                  name varchar(255),
                  link varchar(255),
                  category varchar(255),
                  PRIMARY KEY (id)
                  );";
        if (!$this->runQuery($query)) {
            return false;
        }

		//create the todos table
        $query = "CREATE TABLE todos (
                  id int(16) UNIQUE NOT NULL AUTO_INCREMENT,
                  userID int(16),
                  task varchar(255),
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
		
	}
	
	
	
	
	//setup the sample user
	//called by setup() 
	public function setupSampleUser() {
		
		//create a sample user
		$password = password_hash("password", PASSWORD_DEFAULT);
		$query = "INSERT INTO users
                  (lastName, firstName, email, password, widget0, widget1, widget2) VALUES
                  ('User', 'Sample', 'sample@email.com', '$password', 'spotifyMixedGenParty', 'calc', 'sudoku');";
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

        //add the sample user's bookmarks
        $query = "INSERT INTO bookmarks
                  (userID, name, link, category) VALUES
                  (1, 'Twitter', 'http://twitter.com', 'Social Media'),
                  (1,'Facebook', 'http://facebook.com', 'Social Media'),
                  (1,'Instagram', 'http://instagram.com', 'Social Media'),
                  (1,'Twitter', 'http://twitter.com', 'Social Media'),
                  (1,'Pinterest', 'http://pinterest.com', 'Social Media'),
                  (1,'CNN', 'http://cnn.com', 'News'),
                  (1,'Fox News', 'http://foxnews.com', 'News'),
                  (1,'Huffington Post', 'http://huffingtonpost.com', 'News'),
                  (1,'New York Times', 'http://nytimes.com', 'News'),
                  (1,'National Public Radio', 'http://npr.com', 'News'),
                  (1,'British Broadcasting Corporation', 'http://bbc.com', 'News'),
                  (1,'The Wall Street Journal', 'http://wsj.com', 'News'),
                  (1,'Reddit', 'http://reddit.com', 'Tech'),
                  (1,'TechCrunch', 'http://techcrunch.com', 'Tech'),
                  (1,'Hacker News', 'http://www.news.ycombinator.com', 'Tech');";
        if (!$this->runQuery($query)) {
            return false;
        }

		//add the sample user's twitter info
		$query = "INSERT INTO twitter
                  (userID, oauthToken, oauthTokenSecret, username) VALUES
                  (1, '3031713874-GTxZJAegriyiuu9Xy49mcHnmGshSoU3rwStT6Vk', '6A78bk1hGjDAychFw4wbM2DZJ8TLNKzBPYD3YbDrUmrEc', 'throwawayacat');";
		if (!$this->runQuery($query)) {
			return false;
		}
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