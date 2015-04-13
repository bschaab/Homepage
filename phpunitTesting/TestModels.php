<?php 
	
	require_once "../php/models/DatabaseCommunicator.php";
	require_once "../php/models/Session.php";
	require_once "../php/models/User.php";
	require_once "../php/models/TwitterDB.php";
	
	/* Run with phpunit --stderr TestModels.php */
	
	class TestModels extends PHPUnit_Framework_TestCase
	{


		/**** DatabaseCommunicator Tests ****/

		public function testCreateDBCom()
		{
			$dbCom = new DatabaseCommunicator();
			$dbCom->clean();

			$dbCom->runQuery("SELECT * FROM users WHERE id = 1");
			$result = $dbCom->getQueryResult();
			$id = $result['id'];
			$email = $result['email'];

			$this->assertEquals(1, $id);
			$this->assertEquals('sample@email.com', $email);
		}

		public function testRunDBComQuery()
		{

			$dbCom = new DatabaseCommunicator();
			$dbCom->clean();

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

		public function testSession()
		{

			$session = new Session();
			$session->setSessionVariable("testSessionID", 909);
			$id = $session->getSessionVariable("testSessionID");

			$this->assertEquals(909, $id);

		}


		/**** User Tests ****/

		public function testCreateUser()
		{

			$user = new User();
			$user->setFirstName("Test");
			$user->setLastName("Buddy");
			$user->setEmail("testBuddy@email.com");
			$user->setPassword("password909");
			$user->setQuickbarToDefault();
			$user->saveUser();

			$dbCom = new DatabaseCommunicator();

			$dbCom->runQuery("SELECT * FROM users WHERE email = 'testBuddy@email.com'");
			$result = $dbCom->getQueryResult();

			$this->assertEquals($user->getFirstName(), $result['firstName']);
			$this->assertEquals($user->getLastName(), $result['lastName']);
			$this->assertTrue($result['password'] != "");

		}

		public function testLoadUser()
		{

			$user = new User();
			$user->loadUser(1);

			$this->assertEquals($user->getFirstName(), "Sample");
			$this->assertEquals($user->getLastName(), "User");
			$this->assertTrue($user->getPassword() != "");

		}

		public function testVerifyUser()
		{

			$user = new User();
			$user->setEmail("sample@email.com");
			$this->assertEquals(1, $user->verifyUser("password"));
		}


		/**** Quickbar Tests ****/

		public function testQuickbarAdd()
		{

			$quickbar = new Quickbar();
			$this->assertEquals(0, $quickbar->getSize());
			$quickbar->add("Reddit", "http://reddit.com");
			$this->assertEquals(1, $quickbar->getSize());
			$quickbar->add("The Weather Channel", "http://theweatherchannel.com");
			$this->assertEquals(2, $quickbar->getSize());
		}


		public function testQuickbarClear()
		{

			$quickbar = new Quickbar();
			$this->assertEquals(0, $quickbar->getSize());
			$quickbar->add("Reddit", "http://reddit.com");
			$this->assertEquals(1, $quickbar->getSize());
			$quickbar->clear();
			$this->assertEquals(0, $quickbar->getSize());
		}


		public function testQuickbarSetToDefault()
		{

			$quickbar = new Quickbar();
			$quickbar->setToDefault();
			$titles = $quickbar->getTitles();
			$links = $quickbar->getLinks();
			$icons = $quickbar->getIcons();
			$this->assertEquals(3, sizeof($titles));
			$this->assertEquals(3, sizeof($links));
			$this->assertEquals(3, sizeof($icons));
			$this->assertTrue($quickbar->getTitles()[0] != "");
			$this->assertTrue($quickbar->getLinks()[1] != "");
			$this->assertTrue($quickbar->getIcons()[2] != "");
		}


		public function testQuickbarSet()
		{

			$quickbar = new Quickbar();

			$titles = array();
			$links = array();
			$quickbar->set($titles, $links);
			$this->assertEquals(0, $quickbar->getSize());

			$titles = array("Reddit", "Youtube", "Vimeo", "SoundCloud");
			$links = array("http://reddit.com", "http://youtube.com", "http://vimeo.com", "http://soundcloud.com");
			$quickbar->set($titles, $links);
			$this->assertEquals(4, $quickbar->getSize());
			$this->assertTrue($quickbar->getTitles()[0] != "");
			$this->assertTrue($quickbar->getLinks()[1] != "");
			$this->assertTrue($quickbar->getIcons()[2] != "");
			$this->assertTrue($quickbar->getTitles()[3] != "");
		}

		public function testTwitterDBSaveTokens()
		{
			$twitter = new TwitterDB();
			$twitter->setId(1);
			$twitter->setOauthToken('3031713874-x9u57QrALovisfLd6okzk0xPwhpuRmVOL5umyvL');
			$twitter->setOauthTokenSecret('bgw4yc2FbbDItyOawupGxdaVY0wqrjyUOWximwlcd8OeC');
			$twitter->setUsername('throwawayacat');
			$twitter->setUserID(1);
			$twitter->saveTokens();

			$dbQ = new DatabaseCommunicator();
			$dbQ->runQuery("SELECT * FROM twitter WHERE userID = '1'");
			$result = $dbQ->getQueryResult();

			$this->assertEquals($twitter->getId(), $result['id']);
			$this->assertEquals($twitter->getOauthToken(), $result['oauthToken']);
			$this->assertEquals($twitter->getOauthTokenSecret(), $result['oauthTokenSecret']);
			$this->assertEquals($twitter->getUserID(), $result['userID']);
			$this->assertEquals($twitter->getUsername(), $result['username']);
		}

		public function testTwitterDBLoadTokens()
		{
			$twitter = new TwitterDB();
			$twitter->loadTokens('1');

			$dbQ = new DatabaseCommunicator();
			$dbQ->runQuery("SELECT * FROM twitter WHERE userID = '1'");
			$result = $dbQ->getQueryResult();

			$this->assertEquals($twitter->getId(), $result['id']);
			$this->assertEquals($twitter->getOauthToken(), $result['oauthToken']);
			$this->assertEquals($twitter->getOauthTokenSecret(), $result['oauthTokenSecret']);
			$this->assertEquals($twitter->getUsername(), $result['username']);
		}


		/**** Twitter Tests ****/


	}
	/**** Widget Tests (Parameterized) ****/
	
	
	// getWidget()
	
	// setWidget()
	
	// setWidgetsToDefault()
	
	
	// loadUser() with widgets
	
	
	// saveUser() with widgets
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>