<?php
$sample = "2020-01-01 00:00:00";
$split_date = preg_split("/[-:\s]/", $sample);
print_r($split_date);
?>