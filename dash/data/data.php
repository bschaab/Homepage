<?php 
	
	require_once "../../php/models/Session.php";
	require_once "../../php/models/User.php";
	
	$session = new Session();
	$userID = $session->getSessionVariable("userID");
	$user = new User();
	$user->loadUser($userID);
	
?>

{
	"loggedIn" : <?php if ($userID) echo true; else echo false; ?>,
	"firstName" : "<?= $user->getFirstName() ?>",
	"lastName" : "<?= $user->getLastName() ?>",
	"quickbarItems" : [
		{
			"iconUrl" : "http://i.imgur.com/QmZlg5z.jpg",
			"title" : "Cool Cat 1",
			"url" : "http://i.imgur.com/QmZlg5z.jpg"
		},
		{
			"iconUrl" : "http://imgur.com/PgH4QC5.jpg",
			"title" : "Cool Cat 2",
			"url" : "http://imgur.com/PgH4QC5"
		},
		{
			"iconUrl" : "http://i.imgur.com/nbn0zwo.jpg",
			"title" : "Cool Cat 3",
			"url" : "http://i.imgur.com/nbn0zwo"
		}
	],
	"widgets" : [
		"testWidget",
		"testWidget",
		"testWidget"
	]
}


