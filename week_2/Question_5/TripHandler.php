<?php

require_once "BikeTripMethod.php";
require_once "EconomicTripMethod.php";
require_once "VipTripMethod.php";

class TripHandler {

    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new TripHandler();
        }
        return self::$instance;
    }
    public function getPrice(string $type, TripParam $trip_params){
        switch ($type) {
            case 'bike':
                $bike_new_instance = new BikeTripMethod();
                return $bike_new_instance->calcPrice($trip_params);
                break;
            case 'economic':
                $eco_new_instance = new EconomicTripMethod();
                return $eco_new_instance->calcPrice($trip_params);
                break;
            case 'vip':
                $vip_new_instance = new VipTripMethod();
                return $vip_new_instance->calcPrice($trip_params);
                break;
            default:
                throw new Exception("Invalid trip type.");
            
        }
    }
}


?>