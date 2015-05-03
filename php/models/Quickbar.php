<?php 
	
	require_once "QuickbarItem.php";
	
	/**
	*  This objects represent a quickbar for a user
	*/
	class Quickbar {
		
		protected $quickbarItems = array();
		
		function __construct() {
			
		}
		
		/**
			* getTitles
			* @return string array of titles in the quickbar
 		*/
		function getTitles() {
			$items = [];
			for ($i=0; $i<sizeof($this->quickbarItems); $i++) {
				array_push($items, $this->quickbarItems[$i]->getTitle());
			}
			return $items;
		}
		
		/**
			* getLinks
			* @return string array of links in the quickbar
 		*/
		function getLinks() {
			$items = [];
			for ($i=0; $i<sizeof($this->quickbarItems); $i++) {
				array_push($items, $this->quickbarItems[$i]->getLink());
			}
			return $items;
		}
		
		/**
			* getIcons
			* @return string array of icon urls in the quickbar
 		*/
		function getIcons() {
			$items = [];
			for ($i=0; $i<sizeof($this->quickbarItems); $i++) {
				array_push($items, $this->quickbarItems[$i]->getIcon());
			}
			return $items;
		}
		
		/**
			* getSize
			* @return number of items in the quickbar
 		*/
		function getSize() {
			return sizeof($this->quickbarItems);
		}
		
		
		/**
			* setToDefault set the quickbar to have the default items
 		*/
		public function setToDefault() {
			$this->quickbarItems = [
				new QuickbarItem("Twitter", "http://twitter.com"),
				new QuickbarItem("Facebook", "http://facebook.com"),
				new QuickbarItem("Youtube", "http://youtube.com"),
			];
		}
		
		/**
			* add adds a new QuickbarItem to the Quickbar
			* @param $title the title of the new item to be added to the quickbar
			* @param $link the link of the new item to be added to the quickbar
 		*/
		public function add($title, $link) {
			array_push($this->quickbarItems, new QuickbarItem($title, $link));
		}
		
		/**
			* clear removes all items in the Quickbar
 		*/
		public function clear() {
			$this->quickbarItems = array();
		}
		
		/**
			* set sets the Quickbar to contain the given titles and links
			* @param $titles string array of titles to be added to the quickbar
			* @param $links string array of links to be added to the quickbar
 		*/
		public function set($titles, $links) {
			$this->clear();
			for ($i=0; $i<sizeof($titles); $i++) {
				$this->add($titles[$i], $links[$i]);
			}
		}
	
	}
	
?>