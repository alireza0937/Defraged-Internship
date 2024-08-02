<?php

/* Get the number of Songs for each Band */

require_once "../MySqlDatabaseConnection.php";
require_once "../mysql.php";

$host = "YOUR_HOST_NAME";
$user = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$dbname = "YOUR_DB_NAME";

$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$query_builder = new DatabaseIntraction($connection);
$res = $query_builder
->table("bands")
->select([
    "bands.name AS Band",
    "COUNT(songs.id) AS 'Number_of_Songs'"
])
->join("INNER", "albums", "id", "band_id")
->join("INNER", "songs", "id" , "album_id")
->groupBy("albums.band_id")
->fetchAll();
print_r($res);
?>