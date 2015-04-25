<?php

require_once "BookmarkItem.php";

/**
 * Manages Bookmarks
 */
class Bookmarks {

    protected $bookmarks = array();

    function __construct() {

    }


    function getNames($category) {
        $items = [];
        for ($i=0; $i<sizeof($this->bookmarks); $i++) {
            if ($this->bookmarks[$i]->getCategory()==$category) {
                array_push($items, $this->bookmarks[$i]->getName());
            }
        }
        return $items;
    }

    function getLinks($category) {
        $items = [];
        for ($i=0; $i<sizeof($this->bookmarks); $i++) {
            if ($this->bookmarks[$i]->getCategory()==$category) {
                array_push($items, $this->bookmarks[$i]->getLink());
            }
        }
        return $items;
    }

    function getCategories() {
        $items = [];
        $idx = -1;
        for ($i=0; $i<sizeof($this->bookmarks); $i++) {
            $newCategory = true;
            for ($j=0; $j<=$idx; $j++) {
                if ($idx!=-1 && $items[$j] == $this->bookmarks[$i]->getCategory()) {
                    $newCategory = false;
                }
            }
            if ($newCategory) {
                array_push($items, $this->bookmarks[$i]->getCategory());
                $idx = $idx + 1;
            }
        }
        return $items;
    }

    function getSize() {
        return sizeof($this->bookmarks);
    }


    //set the bookmarks to have the default items
    public function setToDefault() {
        $this->bookmarks = [
            new BookmarkItem("Facebook", "http://facebook.com", 'Social Media'),
            new BookmarkItem("Instagram", "http://instagram.com", 'Social Media'),
            new BookmarkItem("Twitter", "http://twitter.com", 'Social Media'),
            new BookmarkItem("Pinterest", "http://pinterest.com", 'Social Media'),
            new BookmarkItem("CNN", "http://cnn.com", 'News'),
            new BookmarkItem("Fox News", "http://foxnews.com", 'News'),
            new BookmarkItem("Huffington Post", "http://huffingtonpost.com", 'News'),
            new BookmarkItem("New York Times", "http://nytimes.com", 'News'),
            new BookmarkItem("National Public Radio", "http://npr.com", 'News'),
            new BookmarkItem("British Broadcasting Corporation", "http://bbc.com", 'News'),
            new BookmarkItem("The Wall Street Journal", "http://wsj.com", 'News'),
            new BookmarkItem("Reddit", "http://reddit.com", 'Tech'),
            new BookmarkItem("TechCrunch", "http://techcrunch.com", 'Tech'),
            new BookmarkItem("Hacker News", "http://www.news.ycombinator.com", 'Tech')
        ];
    }

    //adds a new BookmarkItem to the Bookmarks
    public function add($name, $link, $category) {
        array_push($this->bookmarks, new BookmarkItem($name, $link, $category));
    }

    //remove all items in the Bookmarks
    public function clear() {
        $this->bookmarks = array();
    }

    //set the Bookmarks to contain the given titles, links, and categories
    public function set($names, $links, $categories) {
        $this->clear();
        for ($i=0; $i<sizeof($names); $i++) {
            $this->add($names[$i], $links[$i], $categories[$i]);
        }
    }

}

?>