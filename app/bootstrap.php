<?php
// Файл, запускающий приложение
require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Task;
use App\Controllers\RouteController;

// Для создания таблицы раскомментировать
//Task::initTaskTable();

date_default_timezone_set('Asia/Krasnoyarsk');
setlocale(LC_ALL, 'ru_RU');

if (isset($page)) {
    RouteController::route($page);
}
elseif (isset($create)){
    $task = new Task();
}
elseif (isset($update)){
    Task::updateTask();
}
elseif (isset($delete)){
    Task::deleteTask();
}
