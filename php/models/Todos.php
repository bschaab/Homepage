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

    /**
     * getId a function that returns the id of the task
     * @return mixed the id of the task in the todolist
     */
    function getId() {
        return $this->id;
    }

    /**
     * getUserID a function that returns the id of the user the task is tied to
     * @return mixed the id of the user the task is tied to
     */
    function getUserID() {
        return $this->userID;
    }

    /**
     * getTask a function that returns the task from the database
     * @return mixed the task from the database
     */
    function getTask() {
        return $this->task;
    }

    /**
     * setId a function that sets the id for the task being added
     * @param $id the id to set for the task being added
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * setUserID a function that sets the userID for the task being added
     * @param $userID the userID to tie the task to
     */
    function setUserID($userID) {
        $this->userID = $userID;
    }

    /**
     * setTask a function that sets the task for the task being added
     * @param $task the task text that is to be set
     */
    function setTask($task) {
        $this->task = $task;
    }

    /**
     * loadTasks a function that loads the tasks for a userID from the database
     * @param $userID the userID for the tasks to be loaded from
     * @return bool a boolean that returns if the loading was successful
     */
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

    /**
     * saveTask a function that saves a task to the database
     * @return int returns -2 only if the saving failed
     */
    function saveTask()
    {
        $dbCom = new DatabaseCommunicator();

        $userID = $this->userID;
        $task = $this->task;

        $this->checkForDuplicates($dbCom, $userID, $task);

        $query = "INSERT INTO todos (userID, task) VALUES ($userID,'$task');";
        if (!$dbCom->runQuery($query)) {
                return -2;
        }
    }

    /**
     * checkForDuplicates a function that checks to make sure that task hasn't already been added
     * @param $dbCom a dbCom used for making the connection to the database
     * @param $userID a userID for the user that we are checking
     * @param $task a task to be checked if it already exists in the database
     * @return int only returns -2 if the database query failed
     */
    function checkForDuplicates($dbCom, $userID, $task) {
        $query = "SELECT * FROM todos WHERE userID=$userID AND task='$task'";
        if(!$dbCom->runQuery($query)){
            return -2;
        }
        $result = $dbCom->getQueryResult();
        if($result != null){
            $redirect_url = "/dash/?alert=todo-duplicate";
            header('Location: ' .  $redirect_url);
            exit;
        }
    }

    /**
     * deleteTask a function that deletes a task from the database
     * @return int only returns 02 if the database query failed
     */
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