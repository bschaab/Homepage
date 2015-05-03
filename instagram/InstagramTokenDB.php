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

    /*
        @param {none}
        @return {tokenID} returns the token ID.
    */
    function getId() {
        return $this->id;
    }

    /*
        @param {none}
        @return {userID} returns the user ID.
    */
    function getUserID() {
        return $this->userID;
    }

    /*
        @param {none}
        @return {token} returns the authentication token.
    */
    function getToken() {
        return $this->token;
    }

    /*
        @param {none}
        @return {instagramID} returns instagram account ID.
    */
    function getInstagramID() {
        return $this->instagramID;
    }

    /*
        @param {id} sets the token ID.
        @returns {none}
    */
    function setId($id) {
        $this->id = $id;
    }

    /*
        @param {userID} sets the user ID.
        @returns {none}
    */
    function setUserID($userID) {
        $this->userID = $userID;
    }

    /*
        @param {oauthToken} sets the authentication token. 
        @returns {none}
    */
    function setOauthToken($oauthToken) {
        $this->oauthToken = $oauthToken;
    }

    /*
        @param {oauthTokenSecret} sets the authentication token's secret.
        @returns {none}
    */
    function setOauthTokenSecret($oauthTokenSecret) {
        $this->oauthTokenSecret = $oauthTokenSecret;
    }

    /* 
        @param {username} sets the username of the Instagram user. 
        @returns {none}
    */
    function setUsername($username) {
        $this->username = $username;
    }

    /*
        Loads content that has a user has already authenticated.
        @param {userID} The userID 
        @returns {none}
    */
    function loadToken($userID)
    {
        $dbCom = new DatabaseCommunicator();

        $query = "SELECT * FROM instagram WHERE userID = $userID";
        if (!$dbCom->runQuery($query)) {
            return false;
        }
        if (!$result = $dbCom->getQueryResult()) {
            return false;
        }
        $this->token = $result['token'];
        $this->userID = $result['userID'];
        $this->instagramID = $result['instagramID'];

        return true;
    }

    /*
        Saves a current Instagram session if it has been authenticated.
        @param {userID} the userID of the user.
        @param {token}  the token for the session.
        @param {instagramID} the ID of the users instagram account. 
        @returns {none}
    */
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

    /*
        Deletes an authentication token from the database,
        requiring the user to log in again to see their content.

        @param {userID} the userID of the user.
        @returns {none} 
    */
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