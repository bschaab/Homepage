<?php

require_once "../models/Session.php";
require_once "../models/DatabaseCommunicator.php";
require_once "../models/User.php";

$session = new Session();
$dbCom = new DatabaseCommunicator();
$user = new User();

$userID = $session->getSessionVariable("userID");
$user->loadUser($userID);

$name = $_POST['linkName'];
$link = $_POST['link'];
$category = $_POST['category'];

//check for valid input
if ($title == "" || $link == "" || $category == "") {
    $redirect_url = "/dash/?alert=quickbar-add-invalid-input";
    header('Location: ' .  $redirect_url);
    exit;
}
if (strpos($link, "http://") === false) {
    $link = "http://" . $link;
}

//add them to the bookmarks and save
$user->addToBookmarks($title, $link, $category);
$status = $user->saveUser();

if ($status < 1) {
    $redirect_url = "/dash/?alert=quickbar-add-fail";
    header('Location: ' .  $redirect_url);
    exit;
}

$redirect_url = "/dash/?alert=quickbar-add-success";
header('Location: ' .  $redirect_url);
exit;


?>