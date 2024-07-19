<?php
function is_palindrome($word) {
    $clean_word = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $word));
    $reverse_word = strrev($clean_word);
    if ($reverse_word == $clean_word) {
        return "Yes";
    }
    return "No";
}
?>

