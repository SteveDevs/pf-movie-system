<?php

namespace App\Traits;

use Carbon\Carbon;

trait IncrementDateTimeTrait {

    /**
     * @param Carbon $startTime
     * @param int $duration
     * @return array
     */
    public function incrementStartEndTime(Carbon $startTime,int $duration) : array
    {
        $startTime = $this->nextIncrement($startTime);
        $endTime = $this->nextIncrement(Carbon::parse($startTime)->addSeconds($duration));

        return [
            'startTime' => $startTime,
            'endTime' => $endTime
        ];
    }

    /**
     * @param Carbon $dateTime
     * @return Carbon
     */
    public function nextIncrement(Carbon $dateTime) : Carbon
    {
        $offset = $dateTime->timestamp % 900;
        print_r($dateTime->toDateTime());
        print_r($offset . PHP_EOL);
        return $dateTime->addSeconds($offset);
    }

}
