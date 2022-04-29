<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MoviePlay;
use App\Http\Resources\BookingResource;
use App\Http\Requests\StoreMovieBookingRequest;
use App\Models\MovieBooking;
use App\Traits\BookingTrait;
use App\Traits\ErrorLogTrait;
use App\Traits\IncrementDateTimeTrait;
use App\Http\Resources\MoviePlayResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CancelMovieBookingRequest;

class BookingController extends Controller
{
    use BookingTrait, IncrementDateTimeTrait, ErrorLogTrait;

    /**
     * @param MovieBooking $movieBooking
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(MovieBooking $movieBooking)
    {
        $bookings = $movieBooking->with('play.movie')->where('user_id', Auth::id())
            ->where('status_id', 1)->get();
        return $this->responseSuccess(BookingResource::collection($bookings));
    }

    /**
     * @param MoviePlay $moviePlay
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(MoviePlay $moviePlay)
    {
        $moviePlay->with('movie')->first();

        return $this->responseSuccess(
            new MoviePlayResource($moviePlay)
        );
    }

    /**
     * @param StoreMovieBookingRequest $request
     * @param MovieBooking $movieBooking
     * @param MoviePlay $moviePlay
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMovieBookingRequest $request, MovieBooking $movieBooking, MoviePlay $moviePlay)
    {
        //Check if seats available

        //Count number of bookings per play
        $bookingsCount = MovieBooking::where('movie_play_id', $request->play_id)->where('status_id', 1)->sum('no_tickets');
        //Theater capacity
        $theaterAllowedAmount = $moviePlay->with('theater')
            ->where('id', $request->play_id)->first()->theater->capacity;
        $noTickets = $request->no_tickets ?? 1;

        if($bookingsCount > $theaterAllowedAmount){
            $this->updateErrorDBLog('Bookings exceed capacity');
            return $this->responseError([], 'Theater has reached capacity');
        }else if($bookingsCount === $theaterAllowedAmount){
            return $this->responseError([], 'Theater has reached capacity');
        }else if(($bookingsCount + $noTickets) > $theaterAllowedAmount){
            return $this->responseError([], 'The theater does not have the capacity for your request');
        }

        //Seats are available
        MovieBooking::create([
            'user_id' => auth('sanctum')->user()->id,
            'movie_play_id' => $request->play_id,
            'unique_ref' => $this->genBookingRef(),
            'status_id' => 1,
            'no_tickets' => $noTickets,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $this->responseSuccess([], 201);
    }

    /**
     * @param CancelMovieBookingRequest $request
     * @param MovieBooking $movieBooking
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelBooking(CancelMovieBookingRequest $request, MovieBooking $movieBooking)
    {
        $getBooking = $movieBooking->with('play')->where('id', $request->id)->first();

        if(now()->addHour()->toDateTimeString() > $getBooking->play->start_time){
            return $this->responseError([], 'Cut off time for cancelling has passed.');
        }

        $getBooking->status_id = 2;
        $getBooking->save();

        return $this->responseSuccess([], 204,'Booking was successfully cancelled');
    }
}
