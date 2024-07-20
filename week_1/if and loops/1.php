<?php
$correct_degrees = true;
$all_degrees = [250, 10, 300];
$sum_of_all_degrees = 0;
foreach ($all_degrees as $value) {
    if ($value != 0) {
        if ($value > 180) {
            $value -= 360;
        }
        $sum_of_all_degrees += abs($value);
    }
    else {
        $correct_degrees = false;
    }
}
if ($sum_of_all_degrees == 180 and $correct_degrees) {
    echo "Yes\n";
}
else {
    echo "No\n";
}
?>