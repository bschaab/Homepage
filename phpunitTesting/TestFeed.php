<?php

	require_once "../php/models/feed/FeedDisplayer.php";

	/* Run with phpunit --stderr TestModels.php */
	class TestFeed extends PHPUnit_Framework_TestCase
	{
		public function testFeedDisplayerLoggedIn() {
			$fd = new FeedDisplayer(1);
			$feedArr = $fd->getFeedToDisplay();
			
			$this->assertGreaterThan(0, count($feedArr), "Logged in user feed was empty");
		}
		
		public function testFeedDisplayerDefault() {
			$fd = new FeedDisplayer(-1);
			$feedArr = $fd->getFeedToDisplay();
			
			$this->assertGreaterThan(0, count($feedArr), "Default feed was empty");
		}
		
		public function testFeedCount() {
			$fd = new FeedDisplayer(1);
			$feedArr = $fd->getFeedToDisplay();
			
			$this->assertLessThan(15, count($feedArr), "Feed has too many elements");
		}
	}
?>
