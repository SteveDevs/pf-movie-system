<?php

namespace App\Traits;

use App\Models\MovieBooking;

trait BookingTrait
{
    public function genBookingRef()
    {
        $ref = substring(Hash::make('sha256', uniqid(rand(100, 1000) . time(), true)), 0, 7);

        return (MovieBooking::where('unique_ref', $ref)->exists()) ? $this->genBookingRef($ref) : $ref;
    }
}
