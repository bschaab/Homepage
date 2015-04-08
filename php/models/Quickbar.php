<?php 
	
	require_once "QuickbarItem.php";
	
	/**
	* Manages a Quickbar
	*/
	class Quickbar {
		
		protected $quickbarItems = array();
		
		function __construct() {
			
		}
		
		
		function getTitles() {
			$items = [];
			for ($i=0; $i<sizeof($this->quickbarItems); $i++) {
				array_push($items, $this->quickbarItems[$i]->getTitle());
			}
			return $items;
		}
		
		function getLinks() {
			$items = [];
			for ($i=0; $i<sizeof($this->quickbarItems); $i++) {
				array_push($items, $this->quickbarItems[$i]->getLink());
			}
			return $items;
		}
		
		function getIcons() {
			$items = [];
			for ($i=0; $i<sizeof($this->quickbarItems); $i++) {
				array_push($items, $this->quickbarItems[$i]->getIcon());
			}
			return $items;
		}
		
		function getSize() {
			return sizeof($this->quickbarItems);
		}
		
		
		//set the quickbar to have the default items
		public function setToDefault() {
			$this->quickbarItems = [
				new QuickbarItem("Twitter", "http://twitter.com"),
				new QuickbarItem("Facebook", "http://facebook.com"),
				new QuickbarItem("Youtube", "http://youtube.com"),
			];
		}
		
		//adds a new QuickbarItem to the Quickbar
		public function add($title, $link) {
			array_push($this->quickbarItems, new QuickbarItem($title, $link));
		}
		
		//remove all items in the Quickbar
		public function clear() {
			$this->quickbarItems = array();
		}
		
		//set the Quickbar to contain the given titles and links
		public function set($titles, $links) {
			$this->clear();
			for ($i=0; $i<sizeof($titles); $i++) {
				$this->add($titles[$i], $links[$i]);
			}
		}
	
	}
	
?>