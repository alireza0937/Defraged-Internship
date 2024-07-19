<?php
$noruze_score = 13;
$days_of_travel = 9;
if ($days_of_travel == 0) {
    echo "20\n";
}
elseif ($days_of_travel == 7) {
    echo "$noruze_score\n";
}
elseif ($days_of_travel > 7) {
    $noruze_score -= $days_of_travel;
    if ($noruze_score < 0) {
        echo "0\n";
    }
    else {
        echo "$noruze_score\n";
    }
}
?>