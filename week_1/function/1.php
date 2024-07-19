<?php
function factorial($num){
    $answer = 1;
    while (1 < $num) {
        $answer *= $num * ($num - 1);
        $num -= 2;
    }
    return $answer;
}
?>