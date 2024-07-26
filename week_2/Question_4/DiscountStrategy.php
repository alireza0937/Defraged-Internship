<?php
interface DiscountStrategy{
    public function priceByDiscount(float $basePrice, string $season);
}
?>