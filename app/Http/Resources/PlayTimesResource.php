<?php

namespace App\Http\Resources;

use App\Traits\IncrementDateTimeTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayTimesResource extends JsonResource
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
            'id' => $this->id,
            'text' => $incrementStartEnd['startTime'] . ' until ' . $incrementStartEnd['endTime']
        ];
    }
}
