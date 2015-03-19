<?php
/**
 * Created by PhpStorm.
 * User: Dion
 * Date: 3/19/2015
 * Time: 7:04 AM
 */

require_once('Instagram.php');


class InstagramContainer {
    private $username;
    private $comment;
    private $contentURL;
    private $contentURL2;
    private $type;

    public function __construct($username,$comment,$contentURL,$contentURL2,$type){
        $this->username = $username;
        $this->comment= $comment;
        $this->contentURL = $contentURL;
        $this->contentURL2= $contentURL2;
        $this->type = $type;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getComment(){
        return $this->comment;
    }


    public function getContentURL(){
        return $this->contentURL;
    }

    public function getContentURL2(){
        return $this->contentURL2;
    }

    public function getType(){
        return $this->type;
    }

} 