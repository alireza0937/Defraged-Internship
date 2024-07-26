<?php
require_once "DiscountStrategy.php";

class WinterDiscountStrategy implements DiscountStrategy{

    public string $product;

    public function priceByDiscount(float $basePrice, string $season){

        $extra_discount = 0;
        if ($this->product == "Jacket") {
            $extra_discount = 0.1;
        }
        switch ($season) {
            case 'spring':
                return  $basePrice - ($basePrice * 0.4) - ($basePrice * $extra_discount);
            case 'summer':
                return  $basePrice - ($basePrice * 0.25) - ($basePrice * $extra_discount);
            case 'winter':
                return  $basePrice - ($basePrice * 0.3) - ($basePrice * $extra_discount);
            default:
                return $basePrice;
        }
    }
}
?>