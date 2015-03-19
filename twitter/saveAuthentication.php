<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 3/19/2015
 * Time: 5:28 AM
 */

require "twitteroauth/autoload.php";
require_once "../php/models/TwitterDB.php";
require_once "../php/models/Session.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$session = new Session();

define("CONSUMER_SECRET","2OSfTohYKDc338orDKT7KzwmuRbctpP65riLFgURLwl9xAn2x5");
define("CONSUMER_KEY", "lv9iiNeCkmBOX523sOqy5BvLI");
define("OAUTH_CALLBACK", "http://localhost/twitter/requestAuthentication.php");

$request_token = [];
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    // Abort! Something is wrong.
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

$twitterDB = new TwitterDB();
$twitterDB->setUserID($session->getSessionVariable('userID'));
$twitterDB->setOauthToken($access_token["oauth_token"]);
$twitterDB->setOauthTokenSecret($access_token["oauth_token_secret"]);
$twitterDB->setUsername($access_token["screen_name"]);

$twitterDB->saveTokens();


?>