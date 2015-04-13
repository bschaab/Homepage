<?php 
	
	require_once "../../php/models/Session.php";
	require_once "../../php/models/User.php";
	
	$session = new Session();
	$userID = $session->getSessionVariable("userID");
	
	//setup user regardless of logged in
	$user = new User();
	$user->setQuickbarToDefault();
	$user->setWidgetsToDefault();
?>
{
	<?php
		if ($userID) {
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
	
	"quickbarItems" : [
		<?php
			
			$quickbarTitles = $user->getQuickbarTitles();
			$quickbarLinks = $user->getQuickbarLinks();
			$quickbarIcons = $user->getQuickbarIcons();
			for ($i=0; $i<sizeof($quickbarTitles); $i++):
			
		?>
		{
			"iconUrl" : "<?php echo $quickbarIcons[$i]; ?>",
			"title" : "<?php echo $quickbarTitles[$i]; ?>",
			"url" : "<?php echo $quickbarLinks[$i]; ?>"
		}<?php if ($i+1 != sizeof($quickbarTitles)) { echo ","; }?>
		<?php endfor; ?>
	],
	"widgets" : [
		"<?php echo $user->getWidget(0); ?>",
		"<?php echo $user->getWidget(1); ?>",
		"<?php echo $user->getWidget(2); ?>"
	],
	
	"bookmarks" : [
		{
			"categoryName" : "Social Media",
			"sites" : [
				{
					"bookmarkName" : "Facebook",
					"bookmarkUrl" : "http://www.facebook.com"
				},
				{
					"bookmarkName" : "Instagram",
					"bookmarkUrl" : "http://www.instagram.com"
				},
				{
					"bookmarkName" : "Twitter",
					"bookmarkUrl" : "http://www.twitter.com"
				},
				{
					"bookmarkName" : "Pinterest",
					"bookmarkUrl" : "http://www.pinterest.com"
				}
			]
		},
		{
			"categoryName" : "News",
			"sites" : [
				{
					"bookmarkName" : "CNN",
					"bookmarkUrl" : "http://www.cnn.com"
				},
				{
					"bookmarkName" : "Fox News",
					"bookmarkUrl" : "http://www.foxnews.com"
				},
				{
					"bookmarkName" : "Huffington Post",
					"bookmarkUrl" : "http://www.huffingtonpost.com"
				},
				{
					"bookmarkName" : "New York Times",
					"bookmarkUrl" : "http://www.nytimes.com"
				},
				{
					"bookmarkName" : "National Public Radio",
					"bookmarkUrl" : "http://www.npr.com"
				},
				{
					"bookmarkName" : "British Broadcasting Corporation",
					"bookmarkUrl" : "http://www.bbc.com"
				},
				{
					"bookmarkName" : "The Wall Street Journal",
					"bookmarkUrl" : "http://www.wsj.com"
				}
			]
		},
		{
			"categoryName" : "Tech",
			"sites" : [
				{
					"bookmarkName" : "Reddit",
					"bookmarkUrl" : "http://www.reddit.com"
				},
				{
					"bookmarkName" : "TechCrunch",
					"bookmarkUrl" : "http://www.techcrunch.com"
				},
				{
					"bookmarkName" : "Hacker News",
					"bookmarkUrl" : "http://www.news.ycombinator.com"
				}
			]
		}
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


