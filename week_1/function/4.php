<?php
function selection_sort($array) {
    $length = count($array);
    for ($i = 0; $i < $length; $i++) {
        $high_index = $i;
        for ($j = $i + 1; $j < $length; $j++) {
            if ($array[$high_index] > $array[$j]) {
                $high_index = $j;
            }
        }
        $temp = $array[$i];
        $array[$i] = $array[$high_index];
        $array[$high_index] = $temp;
    }
    return $array;
}