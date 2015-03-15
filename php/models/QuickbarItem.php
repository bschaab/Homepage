<?php 
	
	/**
	* Manages a QuickbarItem
	*/
	class QuickbarItem {
		
		protected $title
		protected $link
		protected $icon
		
		function __construct($title, $link) {
			$this->title = $title;
			$this->link = $link;
			
			//get icon
			$original = "http://grabicon.com/icon?domain=$link&size=64";
			$destination = "/img/quickbar/icons/" . time() . rand();
			copy($original, $destination);
			
			$this->icon = $destination;
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