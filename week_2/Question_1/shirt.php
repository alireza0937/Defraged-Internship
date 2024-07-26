<?php
require_once "product.php";

class Shirt extends Product {

    const allowedSizes = ['sm', 'md', 'lg', 'xlg', '2xlg'];
    private string $size;

    public function __construct($name, $price, $options, $size){
        parent::__construct($name, $price, $options);
        if (in_array($size, self::allowedSizes)){
            $this->size = $size;
        } else {
            throw new Exception("Invalid size.");
        }
    }

    public function getSize(){
        return $this->size;
    }

    public function setSize($new_size){
        if(in_array($new_size, self::allowedSizes)){
            $this->size = $new_size;
        } else {
            throw new Exception("Invalid size.");
        }   
    }
}

