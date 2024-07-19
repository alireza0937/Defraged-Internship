<?php
$sample = '$123,34.00A';
$answer = "";
$allowed_car = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ',', '.'];
for ($i=0; $i < strlen($sample) ; $i++) { 
    if(in_array($sample[$i], $allowed_car)) {
        $answer .= $sample[$i];
    }
}
echo "$answer\n";
?>
