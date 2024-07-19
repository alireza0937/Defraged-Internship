<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport</title>
</head>
<body>
    <h2>How are you traveling?</h2>
    <?php
    
    if (!isset($_SESSION["transportaion"])) {
        $_SESSION["transportaion"] = ["Automobile", "Jet", "Ferry", "Subway"];
    }
        $modes_of_transportaion = $_SESSION["transportaion"];
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            echo "Travel takes many forms. 
            wheather across town, across the country, or around the world.
             Here is a list of some common modes of transportaions:\n";
            echo "<ul>";
            foreach ($_SESSION["transportaion"] as $modes) {
                echo "<li>$modes</li>";
            }
    ?>
            <br>
            <form action="transport.php" method="post">
                <label for="new_modes">Please add your favorite, local or even imaginary modes of travel to the list, seprate by commas: </label><br><br>
                <input type="text" id="new_modes" name="new_modes"><br><br>
                <button>Go</button>
            </form>

    <?php
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "Here is the list with your additions:\n";
            $user_added_mode = $_POST["new_modes"];
            $new_modes = explode(",", trim($user_added_mode));
            echo "<ul>";
            foreach ($new_modes as $value) {
                if (!empty($value)) {
                    $_SESSION["transportaion"][] = $value;
                }
            }
            foreach ($_SESSION["transportaion"] as $value) {
                echo "<li>$value</li>";
            }        
    ?><br>
        <form action="transport.php" method="POST">
            <label for="new_modes">Add more?</label><br><br>
            <input type="text" id="new_modes" name="new_modes"><br><br>
            <button>Go</button>
        </form>
        <?php
        }
        ?>
<br>
</body>
</html>

