<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 3/18/2015
 * Time: 7:23 PM
 */

require_once('TwitterAPIExchange.php');

 /*set access tokens */
$settings = array(
    'oauth_access_token' => "546318958-aEntJGJERq3qmX7fJszXkEXeW24LTRv3IvKU0bJ8",
    'oauth_access_token_secret' => "Mmg4UuVn9zq2qaoWb9L3rPgapcKrv6scQHo8ELaOZCkpf",
    'consumer_key' => "lv9iiNeCkmBOX523sOqy5BvLI",
    'consumer_secret' => "2OSfTohYKDc338orDKT7KzwmuRbctpP65riLFgURLwl9xAn2x5"
);

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "YOUR_OAUTH_ACCESS_TOKEN",
    'oauth_access_token_secret' => "YOUR_OAUTH_ACCESS_TOKEN_SECRET",
    'consumer_key' => "YOUR_CONSUMER_KEY",
    'consumer_secret' => "YOUR_CONSUMER_SECRET"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

$requestMethod = "GET";

$getfield = '?screen_name=iagdotme&count=20';

$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
?>



