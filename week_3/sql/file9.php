<?php

/* Delete the Band and Album you added in #8 */

require_once "../MySqlDatabaseConnection.php";
require_once "../mysql.php";

$host = "YOUR_HOST_NAME";
$user = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$dbname = "YOUR_DB_NAME";


$connection = new MySqlDatabaseConnection($host, $dbname, $user, $password);
$query_builder = new DatabaseIntraction($connection);
$query_builder
->table("albums")
->delete()
->where("name", "Favorite Album Name")
->exec();

$query_builder
->table("bands")
->delete()
->where('name', 'Favorite Band Name')
->exec();

?>