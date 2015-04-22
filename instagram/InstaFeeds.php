<?php

require_once('Instagram.php');
require_once('InstagramFeeds.php');
require_once('InstagramContainer.php');
//testuiuc
//test12345



$instagram = new InstagramFeeds();
if($instagram->userLoginCheck()){
    $results = $instagram->getUserFeeds(2);
    var_dump($results);
}


?>