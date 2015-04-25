<?php
	require_once 'TwitterFeed.php';
	require_once 'InstagramFeed.php';
	
	class FeedDisplayer {
		
		private $feeds;
		
		public function __construct($userId) {
			$this->feeds = array(new TwitterFeed($userId), new InstagramFeed($userId));
		}
	
		public function getFeedToDisplay() {
		
			$feed_array = array();
		
			forEach($this->feeds as $feed) {
				$feed_items = $feed->getFeedItems();
				
				forEach($feed_items as $feed_item) {
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
			}
			
			return json_encode($feed_array);
		}
	}
	
?>
