<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoviePlay extends Model
{
    public function movie ()
    {
        return $this->hasOne(Movie::class, 'id', 'movie_id');
    }

    public function theater ()
    {
        return $this->hasOne(Theater::class, 'theater_id');
    }

    public function cinema ()
    {
        return $this->hasManyThrough(Theater::class, Cinema::class,'id', 'cinema_id', 'cinema_id');
    }
}
