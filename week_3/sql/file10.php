<?php

/* Get the Average Length of all Songs */

require_once "../MySqlDatabaseConnection.php";
require_once "../mysql.php";

$host = "YOUR_HOST_NAME";
$user = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$dbname = "YOUR_DB_NAME";

$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$query_builder = new DatabaseIntraction($connection);
$res = $query_builder
->table("songs")
->select(["AVG(length) as 'Average Song Duration'"])
->fetchAll();
print_r($res);
?>