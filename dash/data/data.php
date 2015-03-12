<?php 
	
	require_once "../../php/models/Session.php";
	require_once "../../php/models/User.php";
	
	$session = new Session();
	$userID = $session->getSessionVariable("userID");
	
?>

{
	<?php 
		if ($userID) {
			$user = new User();
			$user->loadUser($userID);
	?>
			"loggedIn" : true,
			"firstName" : "<?= $user->getFirstName() ?>",
			"lastName" : "<?= $user->getLastName() ?>",
	<?php 
		}
		else {
	?>
			"loggedIn" : false,
	<?php
		}
	?>
	<?php
		// Default quickbar
		// Icons downloaded from: https://dribbble.com/shots/1233464-24-Free-Flat-Social-Icons
	?>
	
	"quickbarItems" : [
		{
			"iconUrl" : "/img/icons/01_twitter.png",
			"title" : "Twitter",
			"url" : "http://twitter.com"
		},
		{
			"iconUrl" : "/img/icons/02_facebook.png",
			"title" : "Facebook",
			"url" : "http://www.facebook.com"
		},
		{
			"iconUrl" : "/img/icons/03_youtube.png",
			"title" : "Youtube",
			"url" : "http://www.youtube.com"
		},
		{
			"iconUrl" : "/img/icons/07_linkedin.png",
			"title" : "LinkedIn",
			"url" : "http://www.linkedin.com"
		},
		{
			"iconUrl" : "/img/icons/15_tumblr.png",
			"title" : "Tumblr",
			"url" : "http://www.tumblr.com"
		}
	],
	"widgets" : [
		"testWidget",
		"testWidget",
		"testWidget"
	],
	"feed" : [
		{
			"classes" : "feed-item-big",
			"imgSrc" : "",
			"iconSrc" : "",
			"time" : "",
			"title" : "",
			"author" : ""
	]
}


