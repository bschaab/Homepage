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

    /**
     * getId a function that returns the id of the twitter row in the database
     * @return mixed the Id of the twitter row in the database
     */
    function getId() {
        return $this->id;
    }

    /**
     * getUserID a function that returns the userID tied to a twitter row in the database
     * @return mixed the userID that the twitter row in the database is tied to
     */
    function getUserID() {
        return $this->userID;
    }

    /**
     * getOauthToken a function that returns the oauthToken in the database
     * @return mixed the oauthtoken that is stored in the twitter database
     */
    function getOauthToken() {
        return $this->oauthToken;
    }

    /**
     * getOauthTokenSecret a function that returns the oauthTokenSecret in the database
     * @return mixed the oauthtokensecret that is stored the twitter database
     */
    function getOauthTokenSecret() {
        return $this->oauthTokenSecret;
    }

    /**
     * getUsername a function that returns the username in the twitter database
     * @return mixed the twitter user that is stored in the twitter database
     */
    function getUsername() {
        return $this->username;
    }

    /**
     * setId a function that sets the id for the information to be stored in the twitter database
     * @param $id the id to be set for the twitter db row
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * setUserID a function that sets the userID for the tokens to be stored in the twitter database
     * @param $userID the userID to be set for the twitter db row
     */
    function setUserID($userID) {
        $this->userID = $userID;
    }

    /**
     * setOauthToken a function that sets the oauthToken to be stored in the twitter db
     * @param $oauthToken the oauthToken to be set for the twitter db row
     */
    function setOauthToken($oauthToken) {
        $this->oauthToken = $oauthToken;
    }

    /**
     * setoauthTokenSecret a function that sets the oauthTokenSecret to be stored in the twitter db
     * @param $oauthTokenSecret the oauthTokenSecret to be set for the twitter db row
     */
    function setOauthTokenSecret($oauthTokenSecret) {
        $this->oauthTokenSecret = $oauthTokenSecret;
    }

    /**
     * setUsername a function that sets the username to be stored in the twitter db
     * @param $username the username to be set for the twitter db row
     */
    function setUsername($username) {
        $this->username = $username;
    }

    /**
     * loadTokens a function that loads the tokens for a userID from the twitter db
     * @param $userID the userID to load the tokens for
     * @return bool a boolean that is used to tell if the loading was succesful
     */
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

    /**
     * saveTokens a function that saves the tokens to the twitter db
     * @return int returns -2 only if the saving tokens failed
     */
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
    /**
     * @param $dbCom a dbCom to communicate with the db
     * @param $userID the userID to check if the token has been set
     * @return bool returns true if the token is
     */
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