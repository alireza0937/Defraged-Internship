<?php
require_once "MySqlDatabaseConnection.php";
require_once "mysql.php";

$host = "127.0.0.1";
$user = "root";
$password = "alireza1377";
$dbname = "pdopost";
$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
// echo $connection . PHP_EOL;
print_r($connection->getConnection());
?>