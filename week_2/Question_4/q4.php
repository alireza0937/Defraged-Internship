<?php

include_once "autoloader/autoloader.php";

$new_jacket = new Pants("New shirt", "spring", 100);
$new_jacket->setDiscountStrategy("winter");
$reponse = $new_jacket->getPrice();
echo $reponse . PHP_EOL;
?>