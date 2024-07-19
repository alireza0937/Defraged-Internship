<?php

$Color = ['A' => 'Blue', 'B' => 'Green', 'c' => 'Red'];
$lower_answer = [];
$upper_answer = [];

foreach ($Color as $key => $value) {
    # code...
    $lower_answer[$key] = strtolower($value);
    $upper_answer[$key] = strtoupper($value);
}

print_r($lower_answer);
print_r($upper_answer);

?>