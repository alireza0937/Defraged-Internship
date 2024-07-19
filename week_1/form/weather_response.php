<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Response</title>
</head>
<body>
    <h2>How's Your Weather?</h2>
</body>
</html>
<?php
    $inputs_is_valid = true;
    $conditions = $_POST["weather"];
    $city = $_POST["city"];
    $month = $_POST["month"];
    $year = $_POST["year"];

    if (!isset($conditions) or !isset($city) or !isset($month) or !isset($year)) {
        $inputs_is_valid = false;
    }
    if ($inputs_is_valid ) {
        echo "In $city in the month of $month $year, you observed the following weather:\n";
        echo "<ul>";
        foreach ($conditions as $condition) {
            echo "<li>$condition</li>";
        
        }
        exit;
    }
    echo "Inputs are incomplete.";


?>