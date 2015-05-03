<?php
	require_once 'TwitterFeed.php';
	require_once 'InstagramFeed.php';
	
	/**
	 * Helper function for comparing the time of FeedItems, used for the
	 * built-in usort function
	 *
	 * @arg $item1 a FeedItem to compare
	 * @arg $item2 a FeedItem to compare
	 * @returns integer 1 if $item1 comes before $item2, -1 otherwise
	 */
	function compare_feed_items($item1, $item2) {
		return $item1["time"] < $item2["time"] ? 1 : -1;
	}
	
	/**
	 * This object aggregates all the possible feeds, then returns a list of
	 * FeedItems to display.
	 */
	class FeedDisplayer {
		
		private $feeds;
		
		private $priorities = array("feed-item-tiny", "feed-item-small", "feed-item-big", "feed-item-giant");
		
		public function __construct($userId) {
			$this->feeds = array(new TwitterFeed($userId), new InstagramFeed($userId));
		}
	    
	    /**
	     * Gets the FeedItems from all the feeds. To add a feed, add an instance of the feed to the feeds array.
	     * The array is ready to display, sorted and limited
	     * 
	     * @returns an array of FeedItems
	     */
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
