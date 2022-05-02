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
    public function store(StoreMovieBookingRequest $request)
    {
        $handle = (new UserBookMovie($request->play_id, $request->no_tickets))->handle();

        return $handle->success ? $this->responseSuccess([], 201)
            : $this->responseError($handle->messages, 'An error has occurred');
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
