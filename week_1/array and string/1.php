<?php
$sample_text = 'Life is beautiful depending on how you look at life'; 
$expression = "life";

$sample_text_with_lowe_case = strtolower($sample_text);
$expression_with_lowe_case = strtolower($expression);

$answer = substr_count($sample_text_with_lowe_case, $expression_with_lowe_case);
echo "$answer\n";

?>