<?php
	/**
	 * This is the interface that all possible feeds must implement 
     */
	interface ExternalFeed {
		public function __construct($userId);
		
		/**
		 * Gets a list of FeedItem s sorted chronologically for the user this feed object 
		 * was created for
		 * @returns an array of FeedItem s
		 */
		public function getFeedItems();
	}
?>
