<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Add status to array
        $bookingStatuses = ['Created', 'Cancelled', 'Ran'];
        foreach ($bookingStatuses as $bookingStatus){
            $exists = BookingStatus::where('name', $bookingStatus)->exists();
            if(!$exists){
                $model = new BookingStatus();
                $model->name = $bookingStatus;
                $model->save();
            }
        }
    }
}
