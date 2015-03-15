<?php 
	
	require_once "QuickbarItem.php";
	
	/**
	* Manages a Quickbar
	*/
	class Quickbar {
		
		protected $quickbarItems = [];
		
		function __construct() {
			
		}
		
		//set the quickbar to have the default items
		public function setToDefault() {
			$this->quickbarItems = [
				QuickbarItem("Twitter", "http://twitter.com"),
				QuickbarItem("Facebook", "http://facebook.com");
				QuickbarItem("Youtube", "http://youtube.com");
			];
		}
		
		//adds a new QuickbarItem to the Quickbar
		public function add(title, link) {
			array_push($this->quickbarItems, QuickbarItem(title, link));
		}
		
		//remove all items in the Quickbar
		public function clear() {
			$this->quickbarItems = [];
		}
		
		//set the Quickbar to contain the given titles and links
		public function set(titles, links) {
			$this->clear();
			for ($i=0; $i<sizeof(titles); $i++) {
				$this->add(titles[$i], links[$i]);
			}
		}
	
	}
	
?>