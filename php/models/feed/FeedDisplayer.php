<?php
	require_once 'TwitterFeed.php';
	
	class FeedDisplayer {
		public function __construct() {
			
		}
	
		public function getFeedToDisplay($userId) {
			// TODO Fix everything when you have more feeds
			
			$twitter_feed = new TwitterFeed($userId);
			
			$twitter_items = $twitter_feed->getFeedItems();
			
			$feed_array = array();
			forEach($twitter_items as $feed_item) {
				$feed_array[] = array(
						"url" => $feed_item->getLink(),
						"classes" => "feed-item-tiny",
						"imgSrc" => $feed_item->getImage(),
						"iconSrc" => $feed_item->getSourceIcon(),
						"time" => $feed_item->getTime(),
						"title" => $feed_item->getTitle(),
						"author" => $feed_item->getAuthor()
				);
			}
			
			return json_encode($feed_array);
		}
	}
	
?>
