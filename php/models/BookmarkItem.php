<?php

/**
 * Manages a BookmarkItem
 */
class BookmarkItem {

    protected $name;
    protected $link;
    protected $category;
    protected $idx;

    /**
     * __construct a constructor that makes a bookmark item
     * @param $name the name for the bookmark item
     * @param $link the link for the bookmark item
     * @param $category the category for the bookmark item
     * @param $idx the index for the bookmark item
     */
    function __construct($name, $link, $category, $idx) {
        $this->name = $name;
        $this->link = $link;
        $this->category = $category;
        $this->idx = $idx;
    }

    /**
     * getName a function that returns the name of the bookmark item
     * @return mixed the name of the bookmark item
     */
    function getName() {
        return $this->name;
    }

    /**
     * getLink a function that returns the link of the bookmark item
     * @return mixed the link of the bookmark item
     */
    function getLink() {
        return $this->link;
    }

    /**
     * getCategory a function that returns the link of the bookmark item
     * @return mixed the category of the bookmark item
     */
    function getCategory() {
        return $this->category;
    }

    /**
     * getIdx a function that returns the index of the bookmark item
     * @return mixed the index of the bookmark item
     */
    function getIdx() {
        return $this->idx;
    }

}

?>