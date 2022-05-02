<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CinemaTheaterMoviePlayResource;
use App\Models\Cinema;

class CinemaController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get Movie plays for each theater/cinema, except those occurring an hour from now.
        $data = Cinema::with(['plays' => function($q) {
            $q->where('start_time', '>', now()->addHour()->toDateTimeString());
        }], 'plays.movie')->get();

        return $this->responseSuccess(CinemaTheaterMoviePlayResource::collection($data));
    }

}
