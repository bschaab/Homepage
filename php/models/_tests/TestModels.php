<?php 
	
	require_once "../DatabaseCommunicator.php";
	require_once "../Session.php";
	require_once "../User.php";
	
	/* Run with phpunit --stderr TestModels.php */
	
	class TestModels extends PHPUnit_Framework_TestCase {
	
	
		/**** DatabaseCommunicator Tests ****/
		
	    public function testCreateDBCom()
	    {
	        $dbCom = new DatabaseCommunicator();
	
	        $dbCom->runQuery("SELECT * FROM users WHERE id = 1");
	        $result = $dbCom->getQueryResult();
	        $id = $result['id'];
	        $email = $result['email'];
	
	        $this->assertEquals(1, $id);
	        $this->assertEquals('sample@email.com', $email);
	    }
	    
	    public function testRunDBComQuery() {
		    
		    $dbCom = new DatabaseCommunicator();
		    $query = "INSERT INTO users
						(lastName, firstName, email, password) VALUES
						('User2', 'Sample2', 'sample2@email.com', '');";
						
			$dbCom->runQuery($query);
			
			$dbCom->runQuery("SELECT * FROM users WHERE id = 2");
	        $result = $dbCom->getQueryResult();
	        $id = $result['id'];
	        $email = $result['email'];
			
			$this->assertEquals(2, $id);
			$this->assertEquals('sample2@email.com', $email);
			
	    }
	    
	    
	    
	    /**** Session Tests ****/
	    
	    public function testSession() {
		    
		    $session = new Session();
		    $session->setSessionVariable("testSessionID", 909);
		    $id = $session->getSessionVariable("testSessionID");
		    
		    $this->assertEquals(909, $id);
		    
	    }
	    
	    
	    
	    /**** User Tests ****/
	    
	    public function testCreateUser() {
		    
		    $user = new User();
		    $user->setFirstName("Test");
		    $user->setLastName("Buddy");
		    $user->setEmail("testBuddy@email.com");
		    $user->setPassword("password909");
			$user->saveUser();
			
			$dbCom = new DatabaseCommunicator();
			$dbCom->runQuery("SELECT * FROM users WHERE email = 'testBuddy@email.com'");
			$result = $dbCom->getQueryResult();

			$this->assertEquals($user->getFirstName(), $result['firstName']);
			$this->assertEquals($user->getLastName(), $result['lastName']);
			$this->assertTrue($result['password'] != "");
			
	    }
	    
	    public function testLoadUser() {
		    
		    $user = new User();
			$user->loadUser(1);
			
			$this->assertEquals($user->getFirstName(), "Sample");
			$this->assertEquals($user->getLastName(), "User");
			$this->assertTrue($user->getPassword() != "");
			
	    }
	    
	    public function testVerifyUser() {
		    
			$user = new User();
			$user->setEmail("sample@email.com");
			$this->assertEquals(1, $user->verifyUser("password"));
	    }
	    
	    
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>