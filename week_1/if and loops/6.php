<?php
function printSpaces($count) {
    for ($i = 0; $i < $count; $i++) {
        echo " ";
    }
}

function printStars($count) {
    for ($i = 0; $i < $count; $i++) {
        echo "*";
    }
}

$n = 3;
$diameter = 2 * $n + 1;
for ($i = 0; $i <= $n; $i++) {
    printSpaces($n - $i);
    printStars($diameter - 2 * ($n - $i));
    echo "\n";
}

for ($i = $n - 1; $i >= 0; $i--) {
    printSpaces($n - $i);
    printStars($diameter - 2 * ($n - $i));
    echo "\n";
}

?>

