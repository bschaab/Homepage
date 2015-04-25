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

    function getIdxs($category) {
        $items = [];
        for ($i=0; $i<sizeof($this->bookmarks); $i++) {
            if ($this->bookmarks[$i]->getCategory()==$category) {
                array_push($items, $this->bookmarks[$i]->getIdx());
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
            new BookmarkItem("Facebook", "http://facebook.com", 'Social Media', 1),
            new BookmarkItem("Instagram", "http://instagram.com", 'Social Media', 2),
            new BookmarkItem("Twitter", "http://twitter.com", 'Social Media', 3),
            new BookmarkItem("Pinterest", "http://pinterest.com", 'Social Media', 4),
            new BookmarkItem("CNN", "http://cnn.com", 'News', 5),
            new BookmarkItem("Fox News", "http://foxnews.com", 'News', 6),
            new BookmarkItem("Huffington Post", "http://huffingtonpost.com", 'News', 7),
            new BookmarkItem("New York Times", "http://nytimes.com", 'News', 8),
            new BookmarkItem("National Public Radio", "http://npr.com", 'News', 9),
            new BookmarkItem("British Broadcasting Corporation", "http://bbc.com", 'News', 10),
            new BookmarkItem("The Wall Street Journal", "http://wsj.com", 'News', 11),
            new BookmarkItem("Reddit", "http://reddit.com", 'Tech', 12),
            new BookmarkItem("TechCrunch", "http://techcrunch.com", 'Tech', 13),
            new BookmarkItem("Hacker News", "http://www.news.ycombinator.com", 'Tech', 14)
        ];
    }

    //adds a new BookmarkItem to the Bookmarks
    public function add($name, $link, $category, $idx) {
        array_push($this->bookmarks, new BookmarkItem($name, $link, $category, $idx));
    }

    //remove all items in the Bookmarks
    public function clear() {
        $this->bookmarks = array();
    }

    //set the Bookmarks to contain the given titles, links, and categories
    public function set($names, $links, $categories, $idxs) {
        $this->clear();
        for ($i=0; $i<sizeof($names); $i++) {
            $this->add($names[$i], $links[$i], $categories[$i], $idxs[$i]);
        }
    }

    public function remove($name, $link, $category, $idx) {

    }

}

?>