<?php 
	
	require_once "DatabaseCommunicator.php";
	
	class TestDatabaseCommunicator extends PHPUnit_Framework_TestCase {
	
	    public function testCreate()
	    {
	        $dbCom = new DatabaseCommunicator();
	
	        $dbCom->runQuery("SELECT * FROM users WHERE id = 1");
	        $result = $dbCom->getQueryResult();
	        $id = $result['id'];
	        $email = $result['email'];
	
	        $this->assertEquals(1, $id);
	        $this->assertEquals('sample@email.com', $email);
	    }
	
	}
	
?>