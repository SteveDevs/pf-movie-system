<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{

    public function getMovieForBooking($id, Movie $movie)
    {
        $moviePlays = $movie->with('plays')->where('id', $id)->get();

        return $this->responseSuccess(new MovieResource($moviePlays));
    }
}
