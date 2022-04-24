<?php

namespace App\Traits;

use Carbon\Carbon;

trait IncrementDateTimeTrait {

    /**
     * Forces the start and end time to be that of 15 min increments
     * @param string $startTime
     * @param int $duration
     * @return array
     */
    public function incrementStartEndTime(string $startTime,int $duration) : array
    {
        $startTime = Carbon::parse($startTime);
        $startTime = $this->nextIncrement($startTime)->toDateTimeString();
        $endTime = $this->nextIncrement(Carbon::parse($startTime)->addSeconds($duration));

        return [
            'startTime' => $startTime,
            'endTime' => $endTime
        ];
    }

    /**
     * Returns the 15min increment of the time, if the time is at 15 min then returns that
     * @param string $dateTime
     * @return Carbon
     */
    public function nextIncrement(string $dateTime) : Carbon
    {
        $dateTime = Carbon::parse($dateTime);
        $offset = $dateTime->timestamp % 900;
        return ($offset > 0) ? $dateTime->addSeconds(900 - $offset) : $dateTime;
    }

}
