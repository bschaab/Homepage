<?php
	require_once "../../models/Session.php";
	require_once "../../models/InstagramTokenDB.php";
	require_once "../../../instagram/Instagram.php";
	
	define("CLIENT_ID", "f94d2a915bb14ea49ce423ecb37baa2e");
	define("CONSUMER_SECRET", "9dc2efb7889b4309a0e302a41783a20c");
	define("OAUTH_CALLBACK", "http://localhost/php/controllers/instagram/saveAuthentication.php");
	
	$session = new Session();

	$config = array(
        'apiKey' => CLIENT_ID,
        'apiSecret' => CONSUMER_SECRET,
        'apiCallback' => OAUTH_CALLBACK,
    );
    
    $instagram = new Instagram($config);

	if(isset($_GET['code'])) {
		$code = $_GET['code'];				
        $data = $instagram->getOAuthToken($code);
        
        $instagramDb = new InstagramTokenDB();
        $instagramDb->saveToken($session->getSessionVariable('userID'), $data->access_token, $data->user->username);
	}

	header('Location: /dash/');

?>
