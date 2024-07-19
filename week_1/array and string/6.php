<?php
$first_array = ['c1' => 'Red', 'c2' => 'Green', 'c3' => 'White', 'c4' => 'Black'];
$second_array = ['c2', 'c4'];
foreach ($second_array as $value) {
    if (isset($first_array[$value])) {
        unset($first_array[$value]);
    }
}
print_r($first_array);

?>