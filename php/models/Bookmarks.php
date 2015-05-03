<?php

require_once "BookmarkItem.php";

/**
 * Manages Bookmarks
 */
class Bookmarks {

    protected $bookmarks = array();

    function __construct() {

    }

    /**
     * getNames a function that takes a category and returns the list of all bookmark names for that category
     * @param $category a category you would like to get the bookmarks' names from
     * @return array an array with the list of bookmarks' names matching that category
     */
    function getNames($category) {
        $items = [];
        for ($i=0; $i<sizeof($this->bookmarks); $i++) {
            if ($this->bookmarks[$i]->getCategory()==$category) {
                array_push($items, $this->bookmarks[$i]->getName());
            }
        }
        return $items;
    }

    /**
     * getLinks a function that takes a category and returns the links of all bookmarks for that category
     * @param $category a category you would like to get the bookmarks' links from
     * @return array an array with the list of bookmarks' links matching that category
     */
    function getLinks($category) {
        $items = [];
        for ($i=0; $i<sizeof($this->bookmarks); $i++) {
            if ($this->bookmarks[$i]->getCategory()==$category) {
                array_push($items, $this->bookmarks[$i]->getLink());
            }
        }
        return $items;
    }

    /**
     * getCategories a function that returns a list containing all the categories for a user
     * @return array an array that holds all the categories stored for a user
     */
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

    /**
     * getIdxs a function that returns a list of all the indexes for the bookmarks in the category for a user
     * @param $category a category to get the indexes from
     * @return array a list of all the indexes for a category
     */
    function getIdxs($category) {
        $items = [];
        for ($i=0; $i<sizeof($this->bookmarks); $i++) {
            if ($this->bookmarks[$i]->getCategory()==$category) {
                array_push($items, $this->bookmarks[$i]->getIdx());
            }
        }
        return $items;
    }

    /**
     * getSize a function that returns the number of bookmarks for a user
     * @return int an int containing the number of bookmarks for a user
     */
    function getSize() {
        return sizeof($this->bookmarks);
    }


    /**
     * setToDefault a function that sets the default bookmarks for a user to the list below
     */
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


    /**
     * add a function that adds a new BookmarkItem to the Bookmarks
     * @param $name the name of the bookmark to add
     * @param $link the link of the bookmark to add
     * @param $category the category of the bookmark to add
     * @param $idx the index of the bookmark to add
     */
    public function add($name, $link, $category, $idx) {
        array_push($this->bookmarks, new BookmarkItem($name, $link, $category, $idx));
    }


    /**
     * clear a function that removes all the items in the Bookmarks
     */
    public function clear() {
        $this->bookmarks = array();
    }

    /**
     * set a function that sets the Bookmarks to contain the given titles, links, and categories
     * @param $names a name to set the bookmark to
     * @param $links a link to set the bookmark to
     * @param $categories a category to set the bookmark to
     * @param $idxs a index to set the bookmark to
     */
    public function set($names, $links, $categories, $idxs) {
        $this->clear();
        for ($i=0; $i<sizeof($names); $i++) {
            $this->add($names[$i], $links[$i], $categories[$i], $idxs[$i]);
        }
    }
}

?>