<?php

class Product {
    protected string $name;
    protected int $price;
    protected array $options;

    public function __construct(string $name, int $price, array $options){
        $this->name = $name;
        $this->price = $price;
        $this->options = $options;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($new_name){
        $this->name = $new_name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($new_price){
        $this->price = $new_price;
    }

    public function getOptions(){
        return $this->options;
    }

    public function addOptions($new_option){
        $this->options[] = $new_option;
    }

    public function setOptions($options){
        $this->options = $options;
    }
}

