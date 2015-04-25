<?php

/**
 * Manages a BookmarkItem
 */
class BookmarkItem {

    protected $name;
    protected $link;
    protected $category;
    protected $idx;

    function __construct($name, $link, $category, $idx) {
        $this->name = $name;
        $this->link = $link;
        $this->category = $category;
        $this->idx = $idx;
    }

    function getName() {
        return $this->name;
    }

    function getLink() {
        return $this->link;
    }

    function getCategory() {
        return $this->category;
    }

    function getIdx() {
        return $this->idx;
    }

}

?>