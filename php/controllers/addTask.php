<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 3/19/2015
 * Time: 5:28 AM
 */

require_once "../php/models/Todos.php";
require_once "../php/models/Session.php";

header('Location: /index.php');


$session = new Session();

$todos = new Todos();
$todos->setUserID($session->getSessionVariable('userID'));
$todos->setTask($_POST['task']);
$todos->saveTask();


?>