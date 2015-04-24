<?php 
	
	require_once "../../php/models/Session.php";
	require_once "../../php/models/User.php";
	require_once "../../php/models/feed/FeedDisplayer.php";
	
	$session = new Session();
	$userID = $session->getSessionVariable("userID");
	
	//setup user regardless of logged in
	$user = new User();
	$user->setQuickbarToDefault();
	$user->setWidgetsToDefault();

	$feedDisplayer = new FeedDisplayer();	// TODO move this
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

    "todos" : [
        <?php for ($i=0; $i<sizeof($user->getTodos()); $i++):?>
            "<?php echo $user->getTodos()[$i]; ?>"
            <?php if ($i+1 != sizeof($user->getTodos())) { echo ","; }?>
        <?php endfor; ?>
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
	
	"feed" : <?= $feedDisplayer->getFeedToDisplay($userID) ?>
}


