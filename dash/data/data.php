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
			"url" : "http://www.reddit.com/r/aww",
			"classes" : "feed-item-big",
			"imgSrc" : "http://i.imgur.com/ujkWhhV.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "1:00 PM",
			"title" : "Check this cool link out",
			"author" : "John Smith"
		},
		{
			"url" : "http://www.google.com",
			"classes" : "feed-item-small",
			"imgSrc" : "http://i.imgur.com/bOd2iVK.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "2:00 PM",
			"title" : "Test title",
			"author" : "Me"
		},
		
		{
			"url" : "http://www.google.com",
			"classes" : "feed-item-small",
			"imgSrc" : "http://i.imgur.com/bOd2iVK.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "3:00 PM",
			"title" : "Test title",
			"author" : "Me"
		},
		{
			"url" : "http://www.google.com",
			"classes" : "feed-item-big",
			"imgSrc" : "http://i.imgur.com/UC8srbW.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "4:00 PM",
			"title" : "A Corgi",
			"author" : "Me"
		},
		
		{
			"url" : "http://www.google.com",
			"classes" : "feed-item-tiny",
			"imgSrc" : "http://i.imgur.com/bOd2iVK.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "5:00 PM",
			"title" : "Test title",
			"author" : "Me"
		},
		{
			"url" : "http://www.google.com",
			"classes" : "feed-item-tiny",
			"imgSrc" : "http://i.imgur.com/bOd2iVK.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "6:00 PM",
			"title" : "Test title",
			"author" : "Me"
		},
		{
			"url" : "http://www.google.com",
			"classes" : "feed-item-tiny",
			"imgSrc" : "http://i.imgur.com/bOd2iVK.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "7:00 PM",
			"title" : "Test title",
			"author" : "Me"
		},
		
		{
			"url" : "http://www.google.com",
			"classes" : "feed-item-big",
			"imgSrc" : "http://i.imgur.com/bOd2iVK.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "8:00 PM",
			"title" : "Test title",
			"author" : "Me"
		},
		{
			"url" : "http://www.google.com",
			"classes" : "feed-item-small",
			"imgSrc" : "http://i.imgur.com/bOd2iVK.jpg",
			"iconSrc" : "/img/icons/02_facebook.png",
			"time" : "9:00 PM",
			"title" : "Test title",
			"author" : "Me"
		},
		
		{
			"url" : "https://www.youtube.com/watch?v=J---aiyznGQ",
			"classes" : "feed-item-giant",
			"imgSrc" : "https://i.ytimg.com/vi/J---aiyznGQ/hqdefault.jpg",
			"iconSrc" : "/img/icons/03_youtube.png",
			"time" : "10:00 PM",
			"title" : "Charlie Schmidt's Keyboard Cat! - THE ORIGINAL! ",
			"author" : "chuckieart"
		}
	]
}


