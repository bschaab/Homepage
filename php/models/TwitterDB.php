<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 3/19/2015
 * Time: 6:18 AM
 */

require_once "DatabaseCommunicator.php";

class TwitterDB
{

    protected $id;
    protected $userID;
    protected $oauthToken;
    protected $oauthTokenSecret;
    protected $username;

    function __construct() {

    }

    function getId() {
        return $this->id;
    }

    function getUserID() {
        return $this->userID;
    }

    function getOauthToken() {
        return $this->oauthToken;
    }

    function getOauthTokenSecret() {
        return $this->oauthTokenSecret;
    }

    function getUsername() {
        return $this->username;
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

    function loadTokens($userID)
    {
        $dbCom = new DatabaseCommunicator();

        $query = "SELECT * FROM twitter WHERE userID = $userID";
        if (!$dbCom->runQuery($query)) {
            return false;
        }
        if (!$result = $dbCom->getQueryResult()) {
            return false;
        }

        $this->id = $result['id'];
        $this->oauthToken = $result['oauthToken'];
        $this->oauthTokenSecret = $result['oauthTokenSecret'];
        $this->username = $result['username'];

        return true;
    }

    function saveTokens()
    {
        $dbCom = new DatabaseCommunicator();

        $userID = $this->userID;
        $oauthToken = $this->oauthToken;
        $oauthTokenSecret = $this->oauthTokenSecret;
        $username = $this->username;

        $set = $this->isTokenSet($dbCom, $userID);

        if ($set) {
            $query = "UPDATE twitter SET oauthToken='$oauthToken',oauthTokenSecret='$oauthTokenSecret', username='$username' WHERE userID= $userID";
            echo $query;
            if (!$dbCom->runQuery($query)) { return -2; } //general error
        }

        else {
            $query = "INSERT INTO twitter (userID, oauthToken, oauthTokenSecret, username) VALUES ($userID,'$oauthToken','$oauthTokenSecret','$username');";
            if (!$dbCom->runQuery($query)) {
                return -2;
            }
        }
    }

    // checks if token is already set for this user in database
    function isTokenSet($dbCom, $userID) {
        $query = "SELECT * FROM twitter WHERE userID= $userID";
        if (!$dbCom->runQuery($query)) {
            return false;
        }
        if (!$result = $dbCom->getQueryResult()) {
            return false;
        }
        else {
            return true;
        }
    }
}
?>