<?php

require_once "bikeProvider.php";
require_once "clock.php";
require_once "bike.php";


class BikeStore {

    public BikeProvider $provider;
    public Clock $clock;
    public int $expireTime;
    public $storeBikes = [];
    public $borrowedBikes = [];

    public function __construct($provider, $clock, $expireTime)
    {
        $this->provider = $provider;
        $this->clock = $clock;
        $this->expireTime = $expireTime;
    }


    public function borrow(){

        foreach ($this->storeBikes as $key => $bike) {
            if ($bike->status === 'ok') {
                unset($this->storeBikes[$key]);
                $this->borrowedBikes[] = $bike;
                return $bike;
            } elseif ($bike->status === 'broken') {
                $this->provider->repair($bike);
                $bike->status = 'ok';
            }
        }

        foreach ($this->borrowedBikes as $key => $bike) {
            if ($this->clock->getCurrentTime() > $bike->borrowTime + $this->expireTime) {
                unset($this->borrowedBikes[$key]);
                $this->borrowedBikes[] = $bike;
                return $bike;
            }
        }

        $newBike = $this->provider->provide();
        $newBike->borrowTime = $this->clock->getCurrentTime();
        $this->borrowedBikes[] = $newBike;
        return $newBike;

    }

    public function restore(Bike $bike, bool $needsRepair) {
        if (!in_array($bike, $this->borrowedBikes, true)) {
            throw new Exception('This bike does not belong to this store.');
        }

        $key = array_search($bike, $this->borrowedBikes, true);
        unset($this->borrowedBikes[$key]);

        if ($needsRepair) {
            $bike->status = 'broken';
        }

        $this->storeBikes[] = $bike;
    }

    public function borrowedCount(): int {
        return count($this->borrowedBikes);
    }
    
} 
?>