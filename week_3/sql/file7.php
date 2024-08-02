<?php

/* Update the Release Year of the Album with no Release Year */

require_once "../MySqlDatabaseConnection.php";
require_once "../mysql.php";

$host = "YOUR_HOST_NAME";
$user = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$dbname = "YOUR_DB_NAME";

$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$query_builder = new DatabaseIntraction($connection);
$res = $query_builder
->table('albums')
->update(['release_year' => 1986])
->where('id', 4)
->exec();
echo $res . PHP_EOL;
?>