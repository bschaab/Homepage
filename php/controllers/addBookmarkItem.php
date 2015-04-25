<?php

require_once "../models/Session.php";
require_once "../models/DatabaseCommunicator.php";
require_once "../models/User.php";

$session = new Session();
$dbCom = new DatabaseCommunicator();
$user = new User();

$userID = $session->getSessionVariable("userID");
$user->loadUser($userID);

$name = $_POST['bmarkName'];
$link = $_POST['bmarkLink'];
$category = $_POST['bmarkCategory'];

//check for valid input
if ($name == "" || $link == "" || $category == "") {
    $redirect_url = "/dash/?alert=bookmark-invalid-add";
    header('Location: ' .  $redirect_url);
    exit;
}
if (strpos($link, "http://") === false) {
    $link = "http://" . $link;
}

//add them to the bookmarks and save
$user->addToBookmarks($name, $link, $category, -1);
$status = $user->saveUser();

if ($status < 1) {
    $redirect_url = "/dash/?alert=bookmark-add-fail";
    header('Location: ' .  $redirect_url);
    exit;
}

$redirect_url = "/dash/?alert=bookmark-add-success";
header('Location: ' .  $redirect_url);
exit;


?>