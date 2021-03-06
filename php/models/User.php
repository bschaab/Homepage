<?php 
	
	require_once "DatabaseCommunicator.php";
	require_once "Quickbar.php";
    require_once "Bookmarks.php";
	
	/**
	*  This objects represent a user of the homepage service
	*/
	class User {
		
		//personal
		protected $id;
		protected $firstName;
		protected $lastName;
		protected $email;
		protected $hashedPassword;
		
		//widgets
		protected $widgets;
		
		//quickbar
		protected $quickbar;

		//Todos
		protected $todos = array();

        //Bookmarks
        protected $bookmarks;
		
		
		function __construct() {
			$widgets = array();
		}
		
		
		/* Getters & Setters */

		function getTodos(){
			return $this->todos;
		}

		function setTodo($index, $task) {
			$this->todos[$index] = $task;
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
		
		function getQuickbarTitles() {
			return $this->quickbar->getTitles();
		}
		
		function getQuickbarLinks() {
			return $this->quickbar->getLinks();
		}
		
		function getQuickbarIcons() {
			return $this->quickbar->getIcons();
		}

        function getBookmarkNames($category) {
            return $this->bookmarks->getNames($category);
        }

        function getBookmarkLinks($category) {
            return $this->bookmarks->getLinks($category);
        }

        function getBookmarkCategories() {
            return $this->bookmarks->getCategories();
        }

        function getBookmarkIdxs($category) {
            return $this->bookmarks->getIdxs($category);
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
		
		function getWidget($index) {
			return $this->widgets[$index];
		}
		
		function setWidget($index, $widgetName) {
			$this->widgets[$index] = $widgetName;
		}
		
		
		
		
		
		
		
		/**
			* addToQuickbar adds an item to the quickbar
			* @param $title title as a string of the item to be added
			* @param $link link as a string of the item to be added
     	*/
		function addToQuickbar($title, $link) {
			if (!$this->quickbar) { $this->quickbar = new Quickbar(); }
			$this->quickbar->add($title, $link);
		}
		
		/**
			* setQuickbar replaces the whole quickbar
			* @param $titles array of new titles as strings for the quickbar
			* @param $links array of new links as strings for the quickbar
			* 
     	*/
		function setQuickbar($titles, $links) {
			if (!$this->quickbar) { $this->quickbar = new Quickbar(); }
			$this->quickbar->set($titles, $links);
		}
		
		/**
			* setQuickbarToDefault initializes the quickbar to the default set of items
     	*/
		function setQuickbarToDefault() {
			$this->quickbar = new Quickbar();
			$this->quickbar->setToDefault();
		}
		
		/**
			* setWidgetsToDefault initializes the widget set to the default
     	*/
		function setWidgetsToDefault() {
			$this->widgets[0] = 'spotifyMixedGenParty';
	        $this->widgets[1] = 'calc';
	        $this->widgets[2] = 'sudoku';
		}

		/**
			* function
     	*/
        function addToBookmarks($name, $link, $category, $idx) {
            if (!$this->bookmarks) { $this->bookmarks = new Bookmarks(); }
            $this->bookmarks->add($name, $link, $category, $idx);
        }

		/**
			* function
     	*/
        function setBookmarks($names, $links, $categories, $idx) {
            if (!$this->bookmarks) { $this->bookmarks = new Bookmarks(); }
            $this->bookmarks->set($names, $links, $categories, $idx);
        }

		/**
			* function
     	*/
        function setBookmarksToDefault() {
            $this->bookmarks = new Bookmarks();
            $this->bookmarks->setToDefault();
        }
		
		/**
			* loadUser loads in the values for the user from the database given the unique id
			* @param $userID the unique id of the user
			* @return true if success, false otherwise
     	*/
		function loadUser($userID) {
			$dbCom = new DatabaseCommunicator();
	
			$query = "SELECT * FROM users WHERE id = $userID";
	        if (!$dbCom->runQuery($query)) { return false; }
	        if (!$result = $dbCom->getQueryResult()) { return false; }
	        
	        $this->id = $result['id'];
	        $this->firstName = $result['firstName'];
	        $this->lastName = $result['lastName'];
	        $this->email = $result['email'];
	        $this->hashedPassword = $result['password'];
	        $this->widgets[0] = $result['widget0'];
	        $this->widgets[1] = $result['widget1'];
	        $this->widgets[2] = $result['widget2'];
	        
	        
	        //get quickbar
            $query = "SELECT * FROM quickbar WHERE userID = $userID ORDER BY orderIndex ASC";
            if (!$dbCom->runQuery($query)) { return false; }
            $this->quickbar = new Quickbar();
            while ($result = $dbCom->getQueryResult()) {
                $title = $result['title'];
                $link = $result['link'];
                $icon = $result['icon'];
                $this->quickbar->add($title, $link);
            }
            if ($this->quickbar->getSize() == 0) {
                $this->quickbar->setToDefault();
            }

            //get bookmarks
            $query = "SELECT * FROM bookmarks WHERE userID = $userID";
            if (!$dbCom->runQuery($query)) { return false; }
            $this->bookmarks = new Bookmarks();
            while ($result = $dbCom->getQueryResult()) {
                $name = $result['name'];
                $link = $result['link'];
                $idx = $result['id'];
                $category = $result['category'];
                $this->bookmarks->add($name, $link, $category, $idx);
            }
            if ($this->bookmarks->getSize() == 0) {
                $this->bookmarks->setToDefault();
            }

			//Todos
			$query = "SELECT * FROM todos WHERE userID = $userID";
			if (!$dbCom->runQuery($query)) { return false; }
			while ($result = $dbCom->getQueryResult()) {
				$task = $result['task'];
				array_push($this->todos, $task);
			}
	        return true;
		}
		
		/**
			* saveUser saves the user to the database
			* @return the unique id of the user
     	*/
		function saveUser() {
	        
	        //manages updating or inserting the user into the database
	        $this->saveUserInsertUser();
		        
		    //manages updating or inserting the quickbar for the user into the database
	        $this->saveUserInsertQuickbar();

            //manages updating or inserting the bookmarks for the user into the database
            $this->saveUserInsertBookmark();
	        
	        $userID = $this->id;
	        return $userID;
	        
		}
		
		
		/**
			* saveUserInsertUser helper function for saveUser() that handles
			* 	updating/inserting the user into the database
			* 	and setting the unique user id
			* @return unique user id
     	*/
		function saveUserInsertUser() {
			
			$dbCom = new DatabaseCommunicator();
			
			$firstName = $this->firstName;
			$lastName = $this->lastName;
			$email = $this->email;
			$hashedPassword = $this->hashedPassword;
			$quickbar = $this->quickbar;
			$widget0 = $this->widgets[0];
			$widget1 = $this->widgets[1];
			$widget2 = $this->widgets[2];
			
			if ($this->id) {
				$userID = $this->id;
				$query = "UPDATE users SET lastName='$lastName', firstName='$firstName', email='$email', password='$hashedPassword',
				widget0='$widget0', widget1='$widget1', widget2='$widget2' WHERE id=$userID;";
				if (!$dbCom->runQuery($query)) { return -2; } //general error
			}
			else {
				$query = "INSERT INTO users
						(lastName, firstName, email, password, widget0, widget1, widget2) VALUES
						('$lastName', '$firstName', '$email', '$hashedPassword', '$widget0', '$widget1', '$widget2');";
						if (!$dbCom->runQuery($query)) { return -1; } //duplicate user error
						
				//get userID
				$query = "SELECT * FROM users ORDER BY id DESC LIMIT 1;";
				if (!$dbCom->runQuery($query)) { return -2; } //general error
				if (!$result = $dbCom->getQueryResult()) { return -2; } //general error
				$userID = $result['id'];
	        }
	        
	        $this->id = $userID;
			
		}
		
		
		
		/**
			* saveUserInsertQuickbar helper function for saveUser() that handles
			* 	inserting or updating the quickbar for the user
     	*/
		function saveUserInsertQuickbar() {
			
			$dbCom = new DatabaseCommunicator();
			
			$firstName = $this->firstName;
			$lastName = $this->lastName;
			$email = $this->email;
			$hashedPassword = $this->hashedPassword;
			$quickbar = $this->quickbar;
			$widget0 = $this->widgets[0];
			$widget1 = $this->widgets[1];
			$widget2 = $this->widgets[2];
			
			$userID = $this->id;
			
			//clear old quickbar
			$query = "DELETE FROM quickbar WHERE userID = $userID";
			$dbCom->runQuery($query);
			
			//save quickbar
	        $titles = $quickbar->getTitles();
	        $links = $quickbar->getLinks();
	        $icons = $quickbar->getIcons();
	        for ($i=0; $i<$quickbar->getSize(); $i++) {
		        $title = $titles[$i];
		        $link = $links[$i];
		        $icon = $icons[$i];
		        $query = "INSERT INTO quickbar (userID, title, link, icon, orderIndex) VALUES ($userID,'$title','$link','$icon',$i);";
		        if (!$dbCom->runQuery($query)) { return -2; }
		    }
			
		}

        // Helps the function saveUser().
        // Manages updating or inserting the bookmarks for the user into the database.
        /**
			* function
     	*/
        function saveUserInsertBookmark() {

            $dbCom = new DatabaseCommunicator();
            $bookmarks = $this->bookmarks;
            $userID = $this->id;

            //clear old bookmarks
            $query = "DELETE FROM bookmarks WHERE userID = $userID";
            $dbCom->runQuery($query);

            //save bookmarks
            $categories = $bookmarks->getCategories();
            for ($j=0; $j<sizeof($categories); $j++) {
                $names = $bookmarks->getNames($categories[$j]);
                $links = $bookmarks->getLinks($categories[$j]);
                for ($i=0; $i<sizeof($names); $i++) {
                    $name = $names[$i];
                    $link = $links[$i];
                    $category = $categories[$j];
                    $query = "INSERT INTO bookmarks (userID, name, link, category) VALUES ($userID,'$name','$link','$category');";
                    if (!$dbCom->runQuery($query)) {
                        return -2;
                    }
                }
            }

        }
		
		
		/**
			* verifyUser verifies a user by their email and password
			* @return unique user id if verification succeeded, false otherwise
     	*/
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

        // removes a bookmark for the user given an index of the bookmark
        /**
			* function
     	*/
        function removeBookmark($idx) {
            $dbCom = new DatabaseCommunicator();

            $query = "DELETE FROM bookmarks WHERE id=$idx";
            if (!$dbCom->runQuery($query)) { return false; }
        }
		
	
	}
	
?>