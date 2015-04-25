<?php

require_once "../models/Session.php";
require_once "../models/DatabaseCommunicator.php";
require_once "../models/User.php";

$session = new Session();
$dbCom = new DatabaseCommunicator();
$user = new User();

$userID = $session->getSessionVariable("userID");
$user->loadUser($userID);

$names = array();
$links = array();
$categories = array();
for($i=0; isset($_POST["link_" . $i]); $i++) {
    array_push($names, $_POST["name_" . $i]);
    array_push($links, $_POST["link_" . $i]);
    array_push($categories, $_POST["category_" . $i]);
}
$user->setBookmarks($titles, $links, $categories);

$status = $user->saveUser();
//output if there's an error
//if ($status < 1) {
//	echo "error saving the user: " . $status;
//}


?>