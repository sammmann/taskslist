<?php
// Класс, представляющий таблицу tasks
namespace App\Models;

use App\Controllers\TasksDataGateway;
use App\Controllers\Validator;

class Task
{
    public $name;
    public $description;
    public $created_at;

    function __construct() 
    {
        if ( isset($_POST['name']) && isset($_POST['description']) ) {
            $name = Task::ucFirst($_POST['name']);
            $description = Task::ucFirst($_POST['description']);

            if (Validator::validate($name, $description)) {
                $id = TasksDataGateway::store($name, $description);

                if (isset($_COOKIE['tasks'])) {
                    $tasks = $_COOKIE['tasks'] . ',' . $id;
                    setcookie("tasks", $tasks, time() + (86400* 7));
                }
                else{
                    setcookie("tasks", $id, time() + (86400* 7));
                }
            }
        }
    }

    public static function initTaskTable()
    {
        TasksDataGateway::createTable();
    }

    public static function updateTask()
    {
        if ( isset($_POST['name']) && isset($_POST['id']) ) {
            $id = $_POST['id'];
            $name = Task::ucFirst($_POST['name']);

            TasksDataGateway::update($id, $name, 'name');
        }
        elseif ( isset($_POST['description']) && isset($_POST['id']) ) {
            $id = $_POST['id'];
            $description = Task::ucFirst($_POST['description']);

            TasksDataGateway::update($id, $description, 'description');
        }
    }

    public static function deleteTask()
    {
        if ( isset($_POST['id']) ) {
            $id = $_POST['id'];

            TasksDataGateway::delete($id);
        }
    }

    private static function ucFirst($string)
    {
        $string = trim($string);
        $first = mb_strtoupper(mb_substr($string,0,1, 'UTF-8'));
        $last = mb_strtolower(mb_substr($string,1,strlen($string), 'UTF-8'));
        return $first . $last;
    }
}
