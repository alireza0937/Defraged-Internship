<?php
class TripParam{
    private int $startPoint;
    private int $endPoint;
    private bool $isPeakTime;
    private bool $isRainy;
    public static $main_areas = [[1, 2, 2, 4, 3],[2, 1, 4, 2, 3],[3, 5, 1, 3, 2],[4, 3, 3, 1, 2], [3, 3, 2, 2, 1]];


    public function __construct($startPoint, $endPoint, $isPeakTime, $isRainy)
    {
        $this->startPoint = $startPoint;
        $this->endPoint = $endPoint;
        $this->isPeakTime = $isPeakTime;
        $this->isRainy = $isRainy;

    }

    public function getStartPoint(){
        return $this->startPoint;
    }

    public function getEndPoint(){
        return $this->endPoint;
    }

    public function getIsPeakTime(){
        return $this->isPeakTime;
    }

    public function getIsRainy(){
        return $this->isRainy;
    }
}



?>