<?php

class Bike {
    public $id;
    public $name;
    public $price;
    public $status;
    public $borrowTime;

    public function __construct($id, $name, $price, $status, $borrowTime=null) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->status = $status;
        $this->borrowTime = $borrowTime;

    }
    
}