<?php
function is_prime($num) {
    $counter = 0;
    for ($i=1; $i <= $num; $i++) { 
        if ($num % $i == 0) {
            $counter += 1;
        }
    }
    if ($counter <= 2 ) {
        return "Yes";
    }else {
        return "No";
    }
}
?>