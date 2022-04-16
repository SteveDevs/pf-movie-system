<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Movie::firstOrCreate(
            ['name' => "Holmes & Watson"],
            [
                'name' => "Holmes & Watson",
                'duration' => 5400,//1h 30m
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Movie::firstOrCreate(
            ['name' => "The Matrix Revolutions"],
            [
                'name' => "The Matrix Revolutions",
                'duration' => 7740,//2h 9m
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Movie::firstOrCreate(
            ['name' => "The Lord of the Rings: The Two Towers"],
            [
                'name' => "The Lord of the Rings: The Two Towers",
                'duration' => 10740,//2h 59m
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Movie::firstOrCreate(
            ['name' => "The Lord of the Rings: The Return of the King"],
            [
                'name' => "The Lord of the Rings: The Return of the King",
                'duration' => 12060,//3h 21m
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Movie::firstOrCreate(
            ['name' => "Sunshine"], [
            'name' => "Sunshine",
            'duration' => 6420,//1h 47m
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Movie::firstOrCreate(
            ['name' => "Gravity"],
            [
                'name' => "Gravity",
                'duration' => 5460,//1h 31m
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Movie::firstOrCreate(
            ['name' => "Mortal Engines"],
            [
                'name' => "Mortal Engines",
                'duration' => 7680,//2h 8m
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Movie::firstOrCreate(
            ['name' => "The Hobbit: The Battle of the Five Armies"],
            [
                'name' => "The Hobbit: The Battle of the Five Armies",
                'duration' => 8640,//2h 24m
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
