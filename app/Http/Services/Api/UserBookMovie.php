<?php
namespace App\Http\Services\Api;

use App\Models\MovieBooking;
use App\Models\MoviePlay;
use App\Traits\ErrorLogTrait;
use App\Traits\BookingTrait;

/**
 * Api Service action
 */
class UserBookMovie extends Action
{
    use ErrorLogTrait, BookingTrait;

    /**
     * @var int
     */
    private int $playId;

    /**
     * @var int
     */
    private int $noTickets;

    /**
     * @param int $playId
     * @param int $noTickets
     */
    public function __construct(int $playId, int $noTickets = 1)
    {
        parent::__construct();

        $this->playId = $playId;
        $this->noTickets = $noTickets;
    }

    /**
     *
     * @return HandleReturn
     */
    public function handle() : HandleReturn
    {
        $this->checkError();

        //Create booking
        $create = MovieBooking::create([
            'user_id' => auth('sanctum')->user()->id,
            'movie_play_id' => $this->playId,
            'unique_ref' => $this->genBookingRef(),
            'status_id' => 1,
            'no_tickets' => $this->noTickets,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if(!$create){
            $this->success = false;
            $this->messages[] = 'Error in movie booking storage';
        }

        $this->handleReturn->success = $this->success;
        $this->handleReturn->messages = $this->messages;

        return $this->handleReturn;
    }

    /**
     * @return void
     */
    public function checkError() : void
    {
        //Check if seats available
        //Count number of bookings per play
        $bookingsCount = MovieBooking::where('movie_play_id', $this->playId)->where('status_id', 1)->sum('no_tickets');
        //Theater capacity
        $theaterAllowedAmount = MoviePlay::with('theater')
            ->where('id', $this->playId)->first()->theater->capacity;

        if($bookingsCount > $theaterAllowedAmount){
            $this->updateErrorDBLog('Bookings exceed capacity');
            $this->messages[] = 'Bookings exceed capacity';
        }else if($bookingsCount === $theaterAllowedAmount){
            $this->messages[] = 'Theater at maximum capacity';
        }else if(($bookingsCount + $this->noTickets) > $theaterAllowedAmount){
            $this->messages[] = 'The theater does not have the capacity for your request';
        }else{
            $this->success = true;
        }
    }
}
