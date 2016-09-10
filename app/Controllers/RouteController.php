<?php
// Класс, отвечающий за маршруты в приложении
namespace App\Controllers;
use App\Controllers\TasksDataGateway;

class RouteController
{
    public static function route($page = "index")
    {
        if ($page == "index") {
            // Отображаем домашнюю страницу приложения
            require_once("../views/index.php");
        }
        elseif ($page == "list") {
            // Отображаем список заданий
            $tasks = [];
            
            if (isset($_COOKIE['tasks'])) {
                    $taskIds = explode(',', $_COOKIE['tasks']);
                    $tasks = TasksDataGateway::show($taskIds);
                }

            require_once("../views/tasks.php");
        }

    }
}
