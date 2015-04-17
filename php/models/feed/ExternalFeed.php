<?php
	interface ExternalFeed {
		/**
		 * getFeedItems() returns a list of FeedItem s sorted chronologically
		 */
		public function __construct($userId);
		public function getFeedItems();
	}
?>
