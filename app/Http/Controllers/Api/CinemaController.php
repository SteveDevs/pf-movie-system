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
        return CinemaTheaterMoviePlayResource::collection(Cinema::with('plays.movie')->get());
    }

}
