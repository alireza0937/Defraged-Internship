<?php

require_once "product.php";

class Shop {
    private array $repo = [];
    private int $income = 0;

    public function addProduct(Product $product, int $count){
        if ($count <= 0) {
            throw new Exception("Quantity must be a positive integer.");
        }
        $id = count($this->repo) + 1;
        for ($i=$id; $i < $id + $count; $i++) { 
            $this->repo[$i] = $product;
        }
    }

    public function getSuggestion(string $type, mixed $size, int $maxPrice = null, array $options = []){
        $suggestions = [];
        
        foreach ($this->repo as $id => $product) {
            if ((strtolower($type) == 'shirt' && $product instanceof Shirt && $product->getSize() == $size) || 
                (strtolower($type) == 'pants' && $product instanceof Pant && $product->getSize() == $size)) {
                if ($maxPrice === null || $product->getPrice() <= $maxPrice) {
                    $matches = true;
                    foreach ($options as $key => $value) {
                        if (!isset($product->getOptions()[$key]) || $product->getOptions()[$key] != $value) {
                            $matches = false;
                            break;
                        }
                    }
                    if ($matches) {
                        $suggestions[] = $product;
                    }
                }
            }
        }
        return $suggestions;

    }

    public function sell(int $id){
        $product = $this->repo[$id];
        if (isset($product)) {
            $this->income += (int)$product->getPrice();
            unset($this->repo[$id]);
        }
        
    }

    public function getIncome(){
        return $this->income;
    }

    public function getRepo(){
        return $this->repo;
    }
}