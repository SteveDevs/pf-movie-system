<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MoviePlay;
use App\Http\Resources\BookingResource;
use App\Http\Requests\StoreMovieBookingRequest;
use App\Models\MovieBooking;
use App\Traits\IncrementDateTimeTrait;
use App\Http\Resources\MoviePlayResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CancelMovieBookingRequest;
use App\Http\Services\Api\UserBookMovie;

class BookingController extends Controller
{
    use IncrementDateTimeTrait;

    /**
     * @param MovieBooking $movieBooking
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(MovieBooking $movieBooking)
    {
        //Show bookings for user and have not been cancelled.
        //Show bookings where the start time of the play would not be playing for another hour, from now

        $bookings = $movieBooking->with(['play' => function($q) {
            $q->where('start_time', '>', now()->addHour());
        }, 'movie'])->where('user_id', Auth::id())
            ->where('status_id', 1)
            ->get();

        return $this->responseSuccess(BookingResource::collection($bookings));
    }

    /**
     * Make a booking
     * @param StoreMovieBookingRequest $request
     * @param MovieBooking $movieBooking
     * @param MoviePlay $moviePlay
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMovieBookingRequest $request)
    {
        $handle = (new UserBookMovie($request->play_id, $request->no_tickets))->handle();

        return $handle->success ? $this->responseSuccess([], 201)
            : $this->responseError($handle->messages, 'An error has occurred');
    }

    /**
     * Cancel the booking
     * @param CancelMovieBookingRequest $request
     * @param MovieBooking $movieBooking
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelBooking(CancelMovieBookingRequest $request, MovieBooking $movieBooking)
    {
        //Get booking by the booking id
        $getBooking = $movieBooking->with('play')->where('id', $request->id)->first();

        //Check if the play would be occurring in an hour
        if(now()->addHour()->toDateTimeString() > $getBooking->play->start_time){
            //Not allowed to cancel
            return $this->responseError([], 'Cut off time for cancelling has passed.');
        }

        //Status id 2 = cancelled
        $getBooking->status_id = 2;
        $getBooking->save();

        return $this->responseSuccess([], 200,'Booking was successfully cancelled');
    }
}
