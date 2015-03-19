<?php

require_once('Instagram.php');
require_once('InstagramFeeds.php');
require_once('InstagramContainer.php');


$instagram = new InstagramFeeds();
$results = $instagram->getUserFeeds(2);
var_dump($results);




?>