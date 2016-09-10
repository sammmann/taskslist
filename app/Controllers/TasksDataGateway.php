<?php
// Класс, отвечающий за передачу запросов таблице tasks
namespace App\Controllers;
use App\Models\Task;
use PDO;

class TasksDataGateway
{
    public static function createTable()
    {
        require_once '../app/database_conf.php';
        
        $table = "CREATE TABLE IF NOT EXISTS tasks 
         (
             id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
             name VARCHAR(50) NOT NULL UNIQUE,
             description VARCHAR(255) NOT NULL,
             status VARCHAR(25) DEFAULT 'Не завершено',
             created_at TIMESTAMP
         )";

        try {
            $conn->query($table);
        } catch (PDOException $e) {
            echo "PDO error: " . $ex->getMessage();
        }
    }

    public static function store($name, $description) 
    {
        require_once '../app/database_conf.php';

        try {
            $createQuery = "INSERT INTO tasks(name, description, created_at) 
                            VALUES(:name, :description, now())";

            $statement = $conn->prepare($createQuery);

            $statement->execute(array(":name" => $name, ":description" => $description));

            if ($statement) {
                echo "Задание добавлено!";
                return $conn->lastInsertId();
            }

        } catch (PDOException $e) {
            echo "PDO error: " . $ex->getMessage();
        }
    }

    public static function show($ids)
    {
        require_once '../app/database_conf.php';

        try {
            $tasks = array();

            foreach ($ids as $id) {
                $showQuery = "SELECT * FROM tasks WHERE id = $id LIMIT 1";
                $statement = $conn->query($showQuery);
                $rows = $statement->fetchAll(PDO::FETCH_CLASS, "App\\Models\\Task");
                foreach ($rows as $task) {
                    array_push($tasks, $task);
                }
            }         

            return $tasks;

        } catch (PDOException $e) {
            echo "PDO error: " . $ex->getMessage();
        }
    }

    public static function update($id, $value, $target)
    {
        require_once '../app/database_conf.php';

        try {
            if ($target == 'name') {
                $updateQuery = "UPDATE tasks SET name = :name 
                                WHERE id = :id";
                $statement = $conn->prepare($updateQuery);
                $statement->execute(array(":name" => $value, ":id" => $id));
            }
            elseif ($target == 'description') {
                $updateQuery = "UPDATE tasks SET description = :description 
                                WHERE id = :id";
                $statement = $conn->prepare($updateQuery);
                $statement->execute(array(":description" => $value, ":id" => $id));
            }

            if ($statement->rowCount() === 1) {
                echo "Задача обновлена";
            } 
            else {
                echo "Вы не внесли изменений";
            }

        } catch (PDOException $e) {
            echo "PDO error: " . $ex->getMessage();
        }
    }

    public static function delete($id)
    {
        require_once '../app/database_conf.php';

        try {
            $deleteQuery = "DELETE FROM tasks 
                            WHERE id = :id";

            $statement = $conn->prepare($deleteQuery);

            $statement->execute(array(":id" => $id));

            if (isset($_COOKIE['tasks'])) {
                $tasks = str_replace($id, '', $_COOKIE['tasks']);
                if($tasks == ','){
                    setcookie("tasks", $tasks, time() - (86400* 7));
                }
                else{
                    setcookie("tasks", $tasks, time() + (86400* 7));
                }
                
            }

            if ($statement) {
                echo "Задача удалена";
            }

        } catch (PDOException $e) {
            echo "PDO error: " . $ex->getMessage();
        }
    }

}
