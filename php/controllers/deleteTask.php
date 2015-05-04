<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 3/19/2015
 * Time: 5:28 AM
 */

require_once "../models/Todos.php";
require_once "../models/Session.php";

header('Location: /index.php');


$session = new Session();

//Set UserID then delete the task
$todos = new Todos();
$todos->setUserID($session->getSessionVariable('userID'));
$todos->setTask($_POST['hiddenTask']);
$todos->deleteTask();


?>