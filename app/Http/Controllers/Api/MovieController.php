<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    public function index()
    {
        $cinemaTheaterMoviePlays = Cinema::with('theaters.moviePlays')->get();

        return MovieResource::collection(
            $cinemaTheaterMoviePlays
        );
        /*
         *
         *         $moviePlays = Movie::with(['plays' => function ($q){
            $q->whereDate('start_time', '>=', now());
        }])->get();
         */
    }
}
