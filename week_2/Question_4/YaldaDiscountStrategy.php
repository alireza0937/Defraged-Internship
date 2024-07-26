<?php
require_once "DiscountStrategy.php";
class YaldaDiscountStrategy implements DiscountStrategy {

    public string $product;

    public function priceByDiscount(float $basePrice, string $season){
        switch ($this->product) {
            case 'Jacket':
                return $basePrice - ($basePrice * 0.1);
            case 'Socks':
                return $basePrice - ($basePrice * 0.2);
            default:
                return $basePrice - ($basePrice * 0.25);
        }
    }
}

?>