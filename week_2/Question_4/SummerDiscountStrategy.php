<?php
require_once "DiscountStrategy.php";

class SummerDiscountStrategy implements DiscountStrategy{
    public function priceByDiscount(float $basePrice, string $season){
        switch ($season) {
            case 'spring':
                return  $basePrice - ($basePrice * 0.4);
            case 'summer':
                return  $basePrice - ($basePrice * 0.5);
            case 'winter':
                return  $basePrice - ($basePrice * 0.3);
            default:
                return $basePrice;
        }
    }
}
?>