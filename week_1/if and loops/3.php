<?php
$user_input = 50943;
$numberString = strval($user_input);
for ($i = 0; $i < strlen($numberString); $i++) {
    $digit = $numberString[$i];
    echo $digit . ": " . str_repeat($digit, intval($digit)) . "\n";
}
?>
