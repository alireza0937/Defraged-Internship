<?php
require_once "MySqlDatabaseConnection.php";
require_once "mysql.php";

$host = "127.0.0.1";
$user = "root";
$password = "alireza1377";
$dbname = "intern";

$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$query_builder = new DatabaseIntraction($connection);
$res = $query_builder
->table("songs")
->select()
->where("name", "' or 1=1 --")
->fetchAll();
print_r($res);
?>