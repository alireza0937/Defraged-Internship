<?php

/* Select only the Names of all the Bands */

require_once "../MySqlDatabaseConnection.php";
require_once "../mysql.php";

$host = "YOUR_HOST_NAME";
$user = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$dbname = "YOUR_DB_NAME";

$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$query_builder = new DatabaseIntraction($connection);
$res = $query_builder->table("bands")->select(["name AS Band_Name"])->fetchAll();
print_r($res);
?>