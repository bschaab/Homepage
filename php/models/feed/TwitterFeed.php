<?php
	require_once 'ExternalFeed.php';
	require_once 'FeedItem.php';
	require_once __DIR__.'/../TwitterDB.php';
	require_once __DIR__.'/../../../twitter/TwitterAPIExchange.php';
	
	class TwitterFeed implements ExternalFeed {
	
		private $twitter_obj;
	
		public function __construct($userId) {
			$twitterDB = new TwitterDB();
			$twitterDB->loadTokens($userId);
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

			$requestMethod = "GET";

			$getfield = '?screen_name='.$username.'&count=10';

			$this->twitter_obj = new TwitterAPIExchange($settings);
			
		}
		
		public function getFeedItems() {
			$result_str = $this->twitter_obj->setGetfield('?count=10')->buildOauth("https://api.twitter.com/1.1/statuses/home_timeline.json", "GET")->performRequest();
		
			$twitter_objs = json_decode($result_str, true);
			
			$feed_objs = array();
			
			forEach($twitter_objs as $feed_obj) {
				$image_url = "";
			
				$feed_entities = $feed_obj["entities"];
				if(in_array("media", $feed_entities)) {
					$image_url = $feed_entities["media"][0]["media_url"];
				}
				else {
					$image_url = $feed_obj["user"]["profile_banner_url"];
				}
				
				$feed_objs[] = new FeedItem(
					$feed_obj["text"],
					$feed_obj["user"]["name"],
					$feed_obj["created_at"],
					"http://twitter.com/" . $feed_obj["user"]["screen_name"] . "/status/" . $feed_obj["id"],
					"/img/icons/01_twitter.png",
					$image_url,
					1
				);
			}
			
			return $feed_objs;
		}
	}
?>