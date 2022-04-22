<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\MoviePlay;
use App\Models\Theater;
use App\Traits\IncrementDateTimeTrait;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use IncrementDateTimeTrait;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LookupSeeders::class);

        $cinema1 = new Cinema();

        if(!$cinema1->where('name', 'NuMetro (Bedford)')->exists()){
            $cinema1->name = 'NuMetro (Bedford)';
            $cinema1->time_between_movies = 1200;//20 min
            $cinema1->save();

            $theater = new Theater();
            $theater->cinema_id = $cinema1->id;

            $theater2 = new Theater();
            $theater2->cinema_id = $cinema1->id;

            $cinema1->theaters()->save($theater);
            $cinema1->theaters()->save($theater2);
        }

        $cinema2 = new Cinema();
        if(!$cinema2->where('name', 'NuMetro (Menlyn Park)')->exists()){
            $cinema2->name = 'NuMetro (Menlyn Park)';
            $cinema2->time_between_movies = 1200;//20 min
            $cinema2->save();

            $theater = new Theater();
            $theater->cinema_id = $cinema2->id;

            $theater2 = new Theater();
            $theater2->cinema_id = $cinema2->id;

            $cinema2->theaters()->save($theater);
            $cinema2->theaters()->save($theater2);
        }

        $movieData = [];
        $movieData[] = [
            'name' => "Holmes & Watson",
            'duration' => 5400,
            'theater_id' => 1
        ];
        $movieData[] = [
            'name' => "The Matrix Revolutions",
            'duration' => 7740,//2h 9m
            'theater_id' => 1
        ];
        $movieData[] = [
            'name' => "The Lord of the Rings: The Two Towers",
            'duration' => 10740,//2h 59m
            'theater_id' => 2
        ];
        $movieData[] = [
            'name' => "The Lord of the Rings: The Return of the King",
            'duration' => 12060,//3h 21m
            'theater_id' => 2
        ];
        $movieData[] = [
            'name' => "Sunshine",
            'duration' => 6420,//1h 47m
            'theater_id' => 3
        ];
        $movieData[] = [
            'name' => "Gravity",
            'duration' => 5460,//1h 31m
            'theater_id' => 3
        ];
        $movieData[] = [
            'name' => "Mortal Engines",
            'duration' => 7680,//2h 8m
            'theater_id' => 4
        ];
        $movieData[] = [
            'name' => "The Hobbit: The Battle of the Five Armies",
            'duration' => 8640,//2h 24m
            'theater_id' => 4
        ];

        $now = $this->nextIncrement(now()->addMonth());

        Schema::disableForeignKeyConstraints();
        foreach ($movieData as $data){
            $movie = new Movie();
            if(!$movie->where('name', $data['name'])->exists()){
                $movie->name = $data['name'];
                $movie->duration = $data['duration'];
                $movie->save();

                $movePlay = new MoviePlay();
                $movePlay->theater_id = $data['theater_id'];
                $movePlay->movie_id = $movie->id;
                $movePlay->start_time = $now->addDay();

                $movie->plays()->save($movePlay);
            }
        }
    }
}
