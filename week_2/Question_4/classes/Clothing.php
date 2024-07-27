<?php

require_once "SummerDiscountStrategy.php";
require_once "WinterDiscountStrategy.php";
require_once "YaldaDiscountStrategy.php";

class Clothing {

    protected string $name;
    protected string $season;
    protected float $basePrice;
    protected ?DiscountStrategy $discountStrategy = null;

    public function __construct($name, $season, $basePrice)
    {
        $this->name = $name;
        $this->season = $season;
        $this->basePrice = $basePrice;
    }

    public function setDiscountStrategy(string $discountStrategy) {
        switch ($discountStrategy) {
            case 'winter':
                $this->discountStrategy = new WinterDiscountStrategy();
                $this->discountStrategy-> product = get_class($this);
                break;
            case 'summer':
                $this->discountStrategy = new SummerDiscountStrategy();
                break;
            case 'yalda':
                $this->discountStrategy = new YaldaDiscountStrategy();
                $this->discountStrategy-> product = get_class($this);
                break;
        }  
    }

    public function getPrice(){
        if ($this->discountStrategy) {
            $new_price = $this->discountStrategy->priceByDiscount($this->basePrice, $this->season);
            return $new_price;
        }
        return $this->basePrice;
    }
}

?>