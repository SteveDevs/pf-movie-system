<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoviePlayResource;
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
}
