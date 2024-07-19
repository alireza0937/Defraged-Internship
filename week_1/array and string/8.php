<?php
$String1 = 'football';
$String2 = 'footboll';
for ($i=0; $i < strlen($String1); $i++) { 
    if ($String1[$i] != $String2[$i]) {
        echo "First difference between two strings at position $i: $String1[$i] vs $String2[$i]\n";
    }
}
?>