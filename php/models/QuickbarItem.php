<?php 
	
	/**
	* Manages a QuickbarItem
	*/
	class QuickbarItem {
		
		protected $title;
		protected $link;
		protected $icon;
		
		function __construct($title, $link) {
			$this->title = $title;
			$this->link = $link;
			$this->icon = "http://grabicon.com/icon?size=50&origin=" . rand() . ".com&domain=$link"; //TODO: copy this into our server so we don't request everytime
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