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

$url = "https://api.twitter.com/1.1/statuses/home_timeline.json";

$requestMethod = "GET";

$getfield = '?screen_name='.$_POST['handle'].'&count=20';

$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(), true);

/*$feedItem = array(
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

*/
?>



