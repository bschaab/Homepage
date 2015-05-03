<?php 
	
	/**
	*  This objects represent a quickbar item of the quickbar for a user
	*/
	class QuickbarItem {
		
		protected $title;
		protected $link;
		protected $icon;
		
		function __construct($title, $link) {
			$this->title = $title;
			$this->link = $link;
			$this->icon = "http://grabicon.com/icon?size=50&domain=$link";
			//if daily limit is reached, use the API: key=46b9a2bd9dfa049d in the above url
		}
		
		function getTitle() {
			return $this->title;
		}
		
		function getLink() {
			return $this->link;
		}
		
		function getIcon() {
			return $this->icon;
		}
	
	}
	
?>