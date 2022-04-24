<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MoviePlay;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\BookingResource;
use App\Http\Requests\StoreMovieBookingRequest;
use App\Models\MovieBooking;
use App\Traits\BookingTrait;
use App\Http\Resources\MoviePlayResource;

class BookingController extends Controller
{
    use BookingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $bookings = $user->with('bookings')->get();

        return BookingResource::collection($bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MoviePlay $moviePlay)
    {
        $moviePlay->with('movie')->first();

        return $this->responseSuccess(
            new MoviePlayResource($moviePlay)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieBookingRequest $request)
    {
        MovieBooking::create([
            'movie_play_id' => $request->movie_play_id,
            'unique_ref' => $this->genBookingRef(),
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $this->responseSuccess([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovieBooking  $movieBooking
     * @return \Illuminate\Http\Response
     */
    public function cancelBokoing(MovieBooking $movieBooking)
    {
        if(now()->addHour() > $movieBooking->start_time){
            return $this->responseError([], 'Cut off time for cancelling hsa passed.');
        }

        $movieBooking->status_id = 2;
        $movieBooking->save();

        return $this->responseSuccess([], 'Booking was successfully cancelled');
    }
}
