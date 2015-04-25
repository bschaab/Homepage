<?php
	require_once "../../../instagram/Instagram.php";

	define("CLIENT_ID", "f94d2a915bb14ea49ce423ecb37baa2e");
	define("CONSUMER_SECRET", "9dc2efb7889b4309a0e302a41783a20c");
	define("OAUTH_CALLBACK", "http://localhost/php/controllers/instagram/saveAuthentication.php");
	
	$config = array(
        'apiKey' => CLIENT_ID,
        'apiSecret' => CONSUMER_SECRET,
        'apiCallback' => OAUTH_CALLBACK,
    );
    
    $instagram = new Instagram($config);
    
    header('Location:' . $instagram->getLoginUrl() . '')
	
?>
