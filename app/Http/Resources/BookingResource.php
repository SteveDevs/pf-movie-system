<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\IncrementDateTimeTrait;

class BookingResource extends JsonResource
{
    use IncrementDateTimeTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //15 min increments
        $incrementStartEnd = $this->incrementStartEndTime($this->play->start_time, $this->play->movie->duration);
        return [
            'id' => $this->id,
            'start_time' => $incrementStartEnd['startTime'],
            'end_time' => $incrementStartEnd['endTime'],
            'movie_name' => $this->play->movie->name,
            'unique_ref' => $this->unique_ref,
            'no_tickets' => $this->no_tickets,
        ];
    }
}
