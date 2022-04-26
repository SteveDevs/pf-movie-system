<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\IncrementDateTimeTrait;

class CinemaTheaterMoviePlayResource extends JsonResource
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
        $movies = [];
        foreach ($this->plays as $play){
            $incrementStartEnd = $this->incrementStartEndTime($play->start_time, $play->movie->duration);
            $movies[$play->movie_id]['id'] = $play->movie->id;
            $movies[$play->movie_id]['movie_name'] = $play->movie->name;
            $movies[$play->movie_id]['plays'][] = [
                'id' => $play->id,
                'theater_id' => $play->theater_id,
                'start_time' => $incrementStartEnd['startTime'],
                'end_time' => $incrementStartEnd['endTime']
            ];
        }
        //$durationHourMin = CarbonInterval::seconds($this->theaters->movie_plays->movie->duration)->cascade()->forHumans();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'movies' => $movies
        ];
    }
}
