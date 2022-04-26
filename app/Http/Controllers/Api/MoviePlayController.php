<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoviePlayResource;
use App\Http\Resources\PlayTimesResource;
use App\Models\MoviePlay;

class MoviePlayController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MoviePlayResource::collection(MoviePlay::with('movie')->get());
    }

    public function getPlayTimesForMovie($movieId, MoviePlay $moviePlay)
    {
        $playTimes = $moviePlay->with('movie')->where('movie_id', $movieId)->get();

        return $this->responseSuccess(PlayTimesResource::collection($playTimes));
    }
}
