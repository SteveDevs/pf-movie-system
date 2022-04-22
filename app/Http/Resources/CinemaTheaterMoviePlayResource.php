<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\CarbonInterval;
use Carbon\Carbon;

class CinemaTheaterMoviePlayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $plays = [];
        foreach ($this->plays as $play){
            //900 = 15min
            $startOfDay = Carbon::parse($play->start_time)->addSeconds($play->movie->duration)->startOfDay();
            $endTime = Carbon::parse($play->start_time)->addSeconds($play->movie->duration);
            $diffSec = $startOfDay->diffInSeconds($endTime);
            $timeAdded = $diffSec % 900;
            $endTime = $endTime->addSeconds($timeAdded);

            $plays[] = [
                'id' => $play->id,
                'movie_id' => $play->movie_id,
                'theater_id' => $play->theater_id,
                'start_time' => $play->start_time,
                'end_time' => $endTime,
                'movie_name' => $play->movie->name
            ];
        }
        //$durationHourMin = CarbonInterval::seconds($this->theaters->movie_plays->movie->duration)->cascade()->forHumans();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'plays' => $plays
        ];
    }
}
