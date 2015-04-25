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
<?php
$bookmarkCategories = $user->getBookmarkCategories();
for ($i=0; $i<sizeof($bookmarkCategories); $i++):
    $bookmarkNames = $user->getBookmarkNames($bookmarkCategories[$i]);
    $bookmarkLinks = $user->getBookmarkLinks($bookmarkCategories[$i]);
    ?>
    {
    "categoryName" : "<?php echo $bookmarkCategories[$i]; ?>",
    "sites" : [
    <?php
    for ($j=0; $j<sizeof($bookmarkNames); $j++):
        ?>
        {
        "bookmarkName" : "<?php echo $bookmarkNames[$j]; ?>",
        "bookmarkUrl" : "<?php echo $bookmarkLinks[$j]; ?>"
        }
        <?php if ($j+1 != sizeof($bookmarkNames)) { echo ","; }?>
    <?php endfor; ?>
    ]
    }<?php if ($i+1 != sizeof($bookmarkCategories)) { echo ","; }?>
<?php endfor; ?>
],
	
	"feed" : <?= $feedDisplayer->getFeedToDisplay($userID) ?>
}


