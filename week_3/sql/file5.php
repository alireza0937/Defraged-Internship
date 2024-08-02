<?php

/* Get all Bands that have No Albums */

require_once "../MySqlDatabaseConnection.php";
require_once "../mysql.php";

$host = "YOUR_HOST_NAME";
$user = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$dbname = "YOUR_DB_NAME";

$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$query_builder = new DatabaseIntraction($connection);
$res = $query_builder
->table('bands')
->select(["bands.name AS 'Band Name'"])
->join('LEFT', 'albums', 'id' ,'band_id')
->groupBy('bands.id')
->having('COUNT(albums.id) = 0')
->fetchAll();
print_r($res);
?>