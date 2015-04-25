<?php
	require_once 'TwitterFeed.php';
	require_once 'InstagramFeed.php';
	
	function compare_feed_items($item1, $item2) {
	
		error_log("COMPARING");
		error_log($item1["time"]);
		error_log($item2["time"]);
		error_log($item1["time"] > $item2["time"] ? 1 : -1);
	
		return $item1["time"] < $item2["time"] ? 1 : -1;
	}
	
	class FeedDisplayer {
		
		private $feeds;
		
		private $priorities = array("feed-item-tiny", "feed-item-small", "feed-item-big", "feed-item-giant");
		
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
			
			usort($feed_array, "compare_feed_items");
			
			$feed_array = array_slice($feed_array, 0, 15);
			
			return json_encode($feed_array);
		}
	}
	
?>
