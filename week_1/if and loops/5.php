<?php
$user_input = 11;
$counter = 1;
while ($counter <= $user_input) {
    for ($i=1; $i <= $user_input ; $i++) { 
        echo $i*$counter." ";
    }
    $counter += 1;
    echo "\n";
}
?>