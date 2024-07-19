<?php
$sample = "The quick brown fox";
$convert_to_array = explode(" ", $sample);
$delete_last_member = array_pop($convert_to_array);
$convert_to_string = implode(" ", $convert_to_array);
print_r($convert_to_string);
echo "\n";
?>