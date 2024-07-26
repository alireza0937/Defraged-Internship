<?php

require_once "TripMethod.php";

class EconomicTripMethod implements TripMethod{

    public function calcPrice(TripParam $params){

        $base_price = 5000;
        $extra_charge = 1;

        if ($params->getIsPeakTime() and $params->getIsRainy()) {
            $extra_charge = 1.4;
        } elseif ($params->getIsPeakTime()) {
            $extra_charge = 1.2;
        } elseif ($params->getIsRainy()) {
            $extra_charge = 1.2;
        }

        $start_point = $params->getStartPoint() - 1;
        $end_point = $params->getEndPoint() - 1;
        $ratio = $params::$main_areas[$start_point][$end_point];
        $final_cost = ($base_price * $ratio * $extra_charge);
        return $final_cost;
    }

}
?>