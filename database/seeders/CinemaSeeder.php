<?php

namespace Database\Seeders;

use App\Models\Cinema;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cinema::firstOrCreate(
            ['name' => 'NuMetro (Bedford)'],
            [
                'name' => "NuMetro (Bedford)",
                'time_between_movies' => 1200,//20 min
                'created_at' => now(),
                'updated_at' => now()
            ]);

        Cinema::firstOrCreate(
            ['name' => 'NuMetro (Menlyn Park)'],
            [
                'name' => "NuMetro (Menlyn Park)",
                'time_between_movies' => 1200,//20 min
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
