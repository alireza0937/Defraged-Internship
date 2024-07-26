<?php
class Clock {

    public function getCurrentTime(){
        return time();
    }

    public function getReturnTimeDay(int $currentTime, int $expireTime): array {
        $returnTime = $currentTime + $expireTime;
        return [
            'day' => date('Y-m-d', $returnTime)
        ];
    }

    public function getReturnTime(int $currentTime, int $expireTime): array {
        $returnTime = $currentTime + $expireTime;
        return [
            'time' => date('H:i:s', $returnTime)
        ];
    }
}
?>


