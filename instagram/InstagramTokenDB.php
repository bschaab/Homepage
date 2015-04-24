<?php

require_once "../php/models/DatabaseCommunicator.php";


class InstagramTokenDB
{
    protected $id;
    protected $userID;
    protected $token;
    protected $instagramID;

    function __construct() {

    }

    function getId() {
        return $this->id;
    }

    function getUserID() {
        return $this->userID;
    }

    function getToken() {
        return $this->token;
    }


    function getInstagramID() {
        return $this->instagramID;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setOauthToken($oauthToken) {
        $this->oauthToken = $oauthToken;
    }

    function setOauthTokenSecret($oauthTokenSecret) {
        $this->oauthTokenSecret = $oauthTokenSecret;
    }

    function setUsername($username) {
        $this->username = $username;
    }


    function loadToken($userID)
    {
        $dbCom = new DatabaseCommunicator();

        $query = "SELECT * FROM instagram WHERE userID = $userID";
        //echo $query;
        if (!$dbCom->runQuery($query)) {
            return false;
        }
        if (!$result = $dbCom->getQueryResult()) {
            return false;
        }
//        echo $result['token'];
        $this->token = $result['token'];
        $this->userID = $result['userID'];
        $this->instagramID = $result['instagramID'];

        return true;
    }

    function saveToken($userID,$token,$instagramID)
    {
        $dbCom = new DatabaseCommunicator();


        $query = "INSERT INTO instagram (userID,token, instagramID) VALUES ($userID,'$token','$instagramID') ON DUPLICATE KEY UPDATE token = '$token',instagramID = '$instagramID';
";

        if (!$dbCom->runQuery($query)) {
            echo "INSTAGRAM SAVE TOKEN FAILURE";
           // error_log(mysql.error());
            return false;
        }
        return true;
    }


    //
    function deleteToken($userID){
        $dbCom = new DatabaseCommunicator();

        $query = "delete FROM instagram WHERE userID = $userID";


        if (!$dbCom->runQuery($query)) {
            return false;
        }
        if (!$result = $dbCom->getQueryResult()) {
            return false;
        }


        return false;
    }


}
?>