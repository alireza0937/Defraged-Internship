<?php

/* Get the Longest Album */

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
->select(['albums.name AS Name', "albums.release_year AS 'Release Year'", 'SUM(songs.length) AS Duration'])
->join('INNER', 'songs', 'id', 'album_id')
->groupBy('songs.album_id')
->ordering(['Duration'], 'DESC')
->limit(1)
->fetch();
print_r($res);
?>