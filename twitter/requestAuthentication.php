<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 3/19/2015
 * Time: 3:22 AM
 */

define("CONSUMER_SECRET","2OSfTohYKDc338orDKT7KzwmuRbctpP65riLFgURLwl9xAn2x5");
define("CONSUMER_KEY", "lv9iiNeCkmBOX523sOqy5BvLI");
define("OAUTH_CALLBACK", "http://localhost/twitter/saveAuthentication.php");


require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//Get a request token
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
?>
<a href=<?php echo $url;?>>Authorize on twitter.com</a>