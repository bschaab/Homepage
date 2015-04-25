<?php
	require_once 'ExternalFeed.php';
	require_once 'FeedItem.php';
	require_once __DIR__.'/../../../instagram/Instagram.php';
	require_once __DIR__.'/../InstagramTokenDB.php';
	
	class InstagramFeed implements ExternalFeed {
	
		private $instagramObj;
	    private $client_id = "f94d2a915bb14ea49ce423ecb37baa2e";
		private $client_secret = "9dc2efb7889b4309a0e302a41783a20c";
	
		public function __construct($userId) {
		
			$instagramDb = new InstagramTokenDB();

			$config = array(
				'apiKey' => $this->client_id,
				'apiSecret' => $this->client_secret,
				'apiCallback' => "http://localhost/dash/",
			);

			$this->instagramObj = new Instagram($config);
		
			$has_token = $instagramDb->loadToken($userId);
			if($has_token === true){
				$token = $instagramDb->getToken();
				$username = $instagramDb->getInstagramID();
				$this->instagramObj->setAccessToken($token);
			}
		}
		
		public function getFeedItems() {
			$feed_objs = array();
		
			if($this->instagramObj->getAccessToken() !== null && $this->instagramObj->getAccessToken() !== "") {
			
				$feeds = $this->instagramObj->getUserFeed(10);
				foreach ($feeds->data as $media) {
					$feed_objs[] = new FeedItem(
						$media->caption->text,
						$media->user->full_name,
						intval($media->created_time),
						$media->link,
						"/img/icons/10_instagram.png",
						$media->images->low_resolution->url,
						1
					);
				}
			}
			else {
				$popular = $this->instagramObj->getPopularMedia();
				$count = 0;
				for($i = 0; $i < min(10, count($popular->data)); $i++) {
				
					$media = $popular->data[$i];
					if($media !== null) {
						$feed_objs[] = new FeedItem(
							$media->caption !== null ? $media->caption->text : "No caption",
							$media->user->full_name,
							$media->created_time,
							$media->link,
							"/img/icons/10_instagram.png",
							$media->images->low_resolution->url,
							1
						);
					}
				}
			}
			
			return $feed_objs;
		}
	}
?>
