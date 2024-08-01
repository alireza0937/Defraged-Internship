<?php
require_once "MySqlDatabaseConnection.php";
require_once "mysql.php";

$host = "127.0.0.1";
$user = "root";
$password = "alireza1377";
$dbname = "pdopost";
$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$pdo = $connection->getConnection();
$query_builder = new DatabaseIntraction($connection);
$update_data =
[
    "title"=>"new 4 update title inserted by query builder", 
];
$query_builder->table("posts")->update($update_data)->where("body", "first body inserted by query builder")->exec();
?>