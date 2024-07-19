<?php
function reverseString($str){
    $answer = "";
    for ($i=strlen($str)-1; $i >= 0; $i--) { 
        $answer .= $str[$i];
    }
    return $answer;
}
?>