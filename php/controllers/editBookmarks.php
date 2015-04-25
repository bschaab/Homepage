<?php

require_once "../models/Session.php";
require_once "../models/DatabaseCommunicator.php";
require_once "../models/User.php";

$session = new Session();
$dbCom = new DatabaseCommunicator();
$user = new User();

$userID = $session->getSessionVariable("userID");
$user->loadUser($userID);

$idxs = $_POST['deletedBmarkIdxs'];
if (!empty($idxs)) {
    for($i=0; $i < count($idxs); $i++)
    {
        $user->removeBookmark($idxs[$i]);
    }
}

$redirect_url = "/dash/?alert=quickbar-add-success";
header('Location: ' .  $redirect_url);
exit;



?>