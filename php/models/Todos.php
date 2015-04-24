<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 3/19/2015
 * Time: 6:18 AM
 */

require_once "DatabaseCommunicator.php";

class Todos
{

    protected $id;
    protected $userID;
    protected $task;

    function __construct() {

    }

    function getId() {
        return $this->id;
    }

    function getUserID() {
        return $this->userID;
    }

    function getTask() {
        return $this->task;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setTask($task) {
        $this->task = $task;
    }

    function loadTasks($userID)
    {
        $dbCom = new DatabaseCommunicator();

        $query = "SELECT * FROM todos WHERE userID = $userID";
        if (!$dbCom->runQuery($query)) {
            return false;
        }
        if (!$result = $dbCom->getQueryResult()) {
            return false;
        }

        $this->id = $result['id'];
        $this->task = $result['task'];

        return true;
    }

    function saveTask()
    {
        $dbCom = new DatabaseCommunicator();

        $userID = $this->userID;
        $task = $this->task;

        $query = "INSERT INTO todos (userID, task) VALUES ($userID,'$task');";
        if (!$dbCom->runQuery($query)) {
                return -2;
        }
    }

    function deleteTask()
    {
        $dbCom = new DatabaseCommunicator();

        $userID = $this->userID;
        $task = $this->task;

        $query = "DELETE FROM todos WHERE userID=$userID AND task='$task';";
        if (!$dbCom->runQuery($query)) {
            return -2;
        }
    }
}
?>