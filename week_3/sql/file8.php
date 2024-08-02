<?php

/* Insert a record for your favorite Band and one of their Albums */

require_once "../MySqlDatabaseConnection.php";
require_once "../mysql.php";

$host = "YOUR_HOST_NAME";
$user = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$dbname = "YOUR_DB_NAME";


$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$query_builder = new DatabaseIntraction($connection);
$query_builder
->table('bands')
->insert(['name' => 'Favorite Band Name'])
->exec();

$id_in_array_format = $query_builder->table("bands")->select(["id"])->where("name", "Favorite Band Name")->fetch();

$query_builder->table("albums")->insert(["name"=>"Favorite Album Name", "release_year"=>2000, "band_id"=>$id_in_array_format["id"]])->exec();
?>