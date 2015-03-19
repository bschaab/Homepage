<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 3/18/2015
 * Time: 7:23 PM
 */

require_once('TwitterAPIExchange.php');
require_once "../php/models/TwitterDB.php";
require_once "../php/models/Session.php";

$session = new Session();

$twitterDB = new TwitterDB();
$userID = $session->getSessionVariable('userID');
$twitterDB->loadTokens($userID);
$oauth_token = $twitterDB->getOauthToken();
$oauth_token_secret = $twitterDB->getOauthTokenSecret();
$username = $twitterDB->getUsername();

/*set access tokens */
$settings = array(
    'oauth_access_token' => $oauth_token,
    'oauth_access_token_secret' => $oauth_token_secret,
    'consumer_key' => "lv9iiNeCkmBOX523sOqy5BvLI",
    'consumer_secret' => "2OSfTohYKDc338orDKT7KzwmuRbctpP65riLFgURLwl9xAn2x5"
);

$url = "https://api.twitter.com/1.1/statuses/home_timeline.json";

$requestMethod = "GET";

$getfield = '?screen_name='.$username.'&count=20';

$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(), true);

$feedItem = array(
    'tweets' => array()
);

foreach($string as $items)
{
    $feedItem['tweets'][] = array(
        'date'=>$items['created_at'],
        'text'=>$items['text'],
        'name'=>$items['user']['name']
    );
}

echo json_encode($feedItem);
?>


