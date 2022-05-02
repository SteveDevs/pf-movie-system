<?php

namespace App\Traits;

use App\Models\MovieBooking;

trait BookingTrait
{
    /**
     * Generate booking reference
     * @return string
     */
    public function genBookingRef() : string
    {
        //Get last Id
        $last = MovieBooking::latest('id')->latest()->first();
        $nextId = ($last) ? ++$last->id : 1;

        $ref = strtoupper(substr(hash('sha256', $nextId . uniqid(rand(100, 1000) . time(),
                true)), 0, 13));

        return (MovieBooking::where('unique_ref', $nextId . $ref)->exists()) ? $this->genBookingRef($ref) : $ref;
    }
}
