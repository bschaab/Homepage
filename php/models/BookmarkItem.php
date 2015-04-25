<?php

/**
 * Manages a BookmarkItem
 */
class BookmarkItem {

    protected $name;
    protected $link;
    protected $category;

    function __construct($name, $link, $category) {
        $this->name = $name;
        $this->link = $link;
        $this->category = $category;
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

}

?>