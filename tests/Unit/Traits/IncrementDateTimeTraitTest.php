<?php

namespace Tests\Unit\Traits;

use Carbon\Carbon;
use App\Traits\IncrementDateTimeTrait;
use Tests\TestCase;

class IncrementDateTimeTraitTest extends TestCase
{
    use IncrementDateTimeTrait;

    public function testIncrementStartEndTime()
    {
        $startEndTime = $this->incrementStartEndTime('2022-06-07 00:30:00', 6420);

        if($startEndTime['startTime'] == '2022-06-07 00:30:00' && $startEndTime['endTime'] == '2022-06-07 02:30:00'){
            $this->assertTrue(true);
        }else{
            $this->fail();
        }
    }

    public function testNextIncrement()
    {
        $dateTime = '2022-06-07 00:23:01';
        $next = $this->nextIncrement($dateTime)->toDateTimeString();

        if(Carbon::parse($next)->toDateTimeString() == '2022-06-07 00:30:00'){
            $this->assertTrue(true);
        }else{
            $this->fail();
        }
    }

}
