<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\IncrementDateTimeTrait;

class MoviePlayResource extends JsonResource
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
        $incrementStartEnd = $this->incrementStartEndTime($this->start_time, $this->movie->duration);

        return [
            'movie_play_id' => $this->movie_play_id,
            'movie_name' => $this->movie->name,
            'start_time' => $incrementStartEnd['startTime'],
            'end_time' => $incrementStartEnd['endTime'],
            'start_end_time' => $incrementStartEnd['startTime'] . '-' . $incrementStartEnd['endTime'],
        ];
    }
}
