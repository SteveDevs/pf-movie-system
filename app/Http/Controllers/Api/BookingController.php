<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\BookingResource;
use App\Http\Requests\StoreMovieBookingRequest;
use App\Models\MovieBooking;
use App\Traits\BookingTrait;

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

        return BookingResource::collection(
            $bookings
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Movie $movie)
    {

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
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovieBooking  $movieBooking
     * @return \Illuminate\Http\Response
     */
    public function show(MovieBooking $movieBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovieBooking  $movieBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(MovieBooking $movieBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovieBooking  $movieBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovieBooking $movieBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MovieBooking  $movieBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovieBooking $movieBooking)
    {
        //
    }
}
