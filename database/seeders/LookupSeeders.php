<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LookupSeeders extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Separate call for all lookup seeders
        $this->call(BookingStatusSeeder::class);
    }
}
