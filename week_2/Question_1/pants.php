<?php

require_once "product.php";

class Pants extends Product {

    private int $size;

    public function __construct($name, $price, $options, $size){
        parent::__construct($name, $price, $options);
        if ($size % 0 == 0 and $size >= 30 and $size <= 60) {
            $this->size = $size;
        }
    }

    public function getSize(){
        return $this->size;
    }

    public function setSize($new_size){
        if ($new_size % 0 == 0 and $new_size >= 30 and $new_size <= 60) {
            $this->size = $new_size;
        }
    }
}