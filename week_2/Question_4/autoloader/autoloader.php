<?php

spl_autoload_register("myAutoLoader");

function myAutoLoader($classname){

    $path = "classes/";
    $extension = ".php";
    $fullpath = $path . $classname . $extension;

    include_once $fullpath;



}


?>