<?php

require_once('Instagram.php');
require_once('InstagramTokenDB.php');
require_once('InstagramContainer.php');

class InstagramFeeds {
    private $client_id = "f94d2a915bb14ea49ce423ecb37baa2e";
    private $client_secret = "9dc2efb7889b4309a0e302a41783a20c";
    private $callback_url = "http://localhost/instagram/InstaFeeds.php";
    private $user_token;
    private $myFeeds;
    private $DBconnection;
	private $authenticated;


    /*
        Constructor.  Establishes Database connection and 
        authenticates user. 

        @param {none}
        @returns {none}

    */
    public function __construct() {
        $this->DBconnection = new InstagramTokenDB();

        $config = array(
            'apiKey' => $this->client_id,
            'apiSecret' => $this->client_secret,
            'apiCallback' => $this->callback_url,
        );

        $this->myFeeds = new Instagram($config);
        $booles = $this->DBconnection->loadToken(1);
        if($booles == true){
            $token = $this->DBconnection->getToken();
            $username = $this->DBconnection->getInstagramID();
            $this->myFeeds->setAccessToken($token);
        }
        else {
        	$code = '';
        	if (isset($_GET['code'])) {
			$code = $_GET['code'];				
	            $data = $this->myFeeds->getOAuthToken($code);
	            if ($data->user->username == NULL) {
	                echo "<a href='{$this->myFeeds->getLoginUrl()}'>Login with Instagram</a>";
	            }
	            $this->user_token = $code;
	            $this->myFeeds->setAccessToken($data);
        	}
		else {
			$code = '';
			echo "<a href='{$this->myFeeds->getLoginUrl()}'>Login with Instagram</a>";
		}


        }
		 $test = $this->DBconnection->saveToken(1,$data->access_token,$data->user->username);
		if(isset($data)){
	        if($data->access_token != NULL){
	            $test = $this->DBconnection->saveToken(1,$data->access_token,$data->user->username);
	            if($test == false) {
	                error_log(mysql . error());
	            }
	            //echo $data->access_token;
	        }
		}
        echo "<a href= 'https://instagram.com/accounts/logout'> logout </a>";
    }


    /*
        Retreives the login URL of the current feed. 
        @return {loginURL} the login URL of the current feed. 
    */
    public function getLoginUrl(){
        return $this->myFeeds->getLoginUrl();
    }


    /*
        Checks to see if the user is logged in.
        @return {true}  The user is logged in.
        @return {false} The user is not logged in.
    */
    public function userLoginCheck(){
		if(isset($_GET['code'])){
			return true;
		}	
		else {
	        return false;					
		}
    }

    /*
        Sets the Instagram token for authentication. 
        @param  {none}
        @return {none}
    */
    public function setToken(){
        if ($_SESSION['InstagramAccessToken'] == ''){
            $accessToken = $this->myFeeds->getAccessToken();
            $_SESSION['InstagramAccessToken'] = $accessToken;
            echo "TOKEN NOT SET";
        } else {
            $accessToken = $_SESSION['InstagramAccessToken'];
            $this->myFeeds->setAccessToken($_SESSION['InstagramAccessToken']);
            echo "TOKEN SET";
        }
    }

    /*
        Retreives the most popular feeds for set user.
        @param {limit} The number of feeds 
        @return {none}
    */
    public function getPopularFeeds($limit){
        $feedsList = array();
        if($limit < 0) {
            return array();
        }
        $popular = $this->myFeeds->getPopularMedia();
        $counter = 0;
        foreach ($popular->data as $media) {
            $contentURL = "";
            $username = "";
            $comment = "";
            $type = "";

            if($counter == $limit){
                break;
            }
            $counter = $counter +1;
            $content = "<li>";
            // output media
            if ($media->type === 'video') {
                // video
                $poster = $media->images->low_resolution->url;
                $source = $media->videos->standard_resolution->url;
                $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
                $contentURL = $poster;
                $contentURL2 = $source;
                $type = "video";
            } else {
                // image
                $image = $media->images->low_resolution->url;
                $content .= "<img class=\"media\" src=\"{$image}\"/>";
                $contentURL = $image;
                $contentURL2 = "";
                $type = "image";
            }
            // create meta section
            $avatar = $media->user->profile_picture;
            $username = $media->user->username;
            $comment = (!empty($media->caption->text)) ? $media->caption->text : '';
            $content .= "<div class=\"content\">
                           <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
                           <p>username: {$username}</p>
                           <div class=\"comment\">COMMENTER: {$comment}</div>
                         </div>";
            // output media
            echo $content . "</li>";
            $singleFeed = new InstagramContainer($username,$comment,$contentURL,$contentURL2,$type);
            array_push($feedsList,$singleFeed);
        }
        return $feedsList;
    }

    /*
        Retreives the feeds for set user.
        @param {limit} The number of feeds 
        @return {none}
    */
    public function getUserFeeds($limit){
        $feedsList = array();
        if($limit < 0) {
            return array();
        }
        $feeds = $this->myFeeds->getUserFeed($limit);
        $counter = 0;
        foreach ($feeds->data as $media) {
            $contentURL = "";
            $username = "";
            $comment = "";
            $type = "";

            if($counter == $limit){
                break;
            }
            $counter = $counter +1;
            $content = "<li>";
            // output media
            if ($media->type === 'video') {
                // video
                $poster = $media->images->low_resolution->url;
                $source = $media->videos->standard_resolution->url;
                $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
                $contentURL = $poster;
                $contentURL2 = $source;
                $type = "video";
            } else {
                // image
                $image = $media->images->low_resolution->url;
                $content .= "<img class=\"media\" src=\"{$image}\"/>";
                $contentURL = $image;
                $contentURL2 = "";
                $type = "image";
            }
            // create meta section
            $avatar = $media->user->profile_picture;
            $username = $media->user->username;
            //var_dump($media);
            //echo "TIME";
            //echo $media->user->created_time;
            $comment = (!empty($media->caption->text)) ? $media->caption->text : '';
            $content .= "<div class=\"content\">
                           <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
                           <p>username: {$username}</p>
                           <div class=\"comment\">COMMENTER: {$comment}</div>
                         </div>";
            // output media
            echo $content . "</li>";
            $singleFeed = new InstagramContainer($username,$comment,$contentURL,$contentURL2,$type);
            array_push($feedsList,$singleFeed);
        }

        return $feedsList;
    }


} 
