<?php
function is_lowercase($word){
    if (ctype_lower($word)) {
        return "Yes";
    }
    else{
        return "No";
    }
}
?>