<?php
    /**
     * This object represents one item to display in the feed
     */
	class FeedItem {
		protected $title;
		protected $author;
		protected $time;
		protected $link;
		protected $icon;
		protected $image;
		
		function __construct($title, $author, $time, $link, $icon, $image, $priority) {
			$this->title = $title;
			$this->author = $author;
			$this->time = $time;
			$this->link = $link;
			$this->icon = $icon;
			$this->image = $image;
			$this->priority = $priority;
		}
		
		function getTitle() {
			return $this->title;
		}
		
		function getAuthor() {
			return $this->author;
		}
		
		function getTime() {
			return $this->time;
		}
		
		function getLink() {
			return $this->link;
		}
		
		function getSourceIcon() {
			return $this->icon;
		}
		
		function getImage() {
			return $this->image;
		}
		
		function getPriority() {
			return $this->priority;
		}
	}
?>
