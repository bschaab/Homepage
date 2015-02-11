<?php 
	
	class SampleTest extends PHPUnit_Framework_TestCase {
	
	    public function testSample()
	    {
	        $a = 3;
	
	        $b = 4;
	
	        $this->assertEquals(7, $a + $b);
	    }
	    
	    public function testSample()
	    {
	        $a = 3;
	
	        $b = 4;
	
	        $this->assertFalse(7 == $a - $b);
	    }
	
	}
	
?>