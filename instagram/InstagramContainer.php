<?php

require_once('Instagram.php');

class InstagramContainer {
    private $username;
    private $comment;
    private $contentURL;
    private $contentURL2;
    private $type;

    /*
        Instagram Constructor.

        @param {username}       Username of Instagram user
        @param {comment}        Comment by Instagram user
        @param {contentURL}     URL of Instagram user content 
        @param {contentURL2}    URL for additional content
        @param {type}           Type of Instagram content
    */
    public function __construct($username,$comment,$contentURL,$contentURL2,$type){
        $this->username = $username;
        $this->comment= $comment;
        $this->contentURL = $contentURL;
        $this->contentURL2= $contentURL2;
        $this->type = $type;
    }

    /*
        @returns {username} Username of Instagram user
     */
    public function getUsername(){
        return $this->username;
    }

    /*
        @returns {comment} Comment by Instagram user
     */
    public function getComment(){
        return $this->comment;
    }

    /*
        @returns {contentURL} URL of Instagram user content 
     */
    public function getContentURL(){
        return $this->contentURL;
    }

    /*
        @returns {contentURL2} URL for additional content
    */
    public function getContentURL2(){
        return $this->contentURL2;
    }

    /*
        @returns {type} Type of Instagram content
    */
    public function getType(){
        return $this->type;
    }

} 