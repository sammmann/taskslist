<?php

define("DSN", "mysql:host=localhost;dbname=taskslist");
define("USERNAME", "root");
define("PASSWORD", "1234");

$options = array(
                 PDO::ATTR_PERSISTENT => true,
                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 );

try{
    $conn = new PDO(DSN, USERNAME, PASSWORD, $options);
}
catch(PDOException $ex){
    echo "PDO error: " . $ex->getMessage();
}
