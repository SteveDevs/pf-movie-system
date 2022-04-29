<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieBooking extends Model
{
    protected $fillable = ['user_id', 'movie_play_id', 'unique_ref', 'status_id', 'no_tickets'];

    public function play()
    {
        return $this->hasOne(MoviePlay::class, 'id', 'movie_play_id');
    }

    public function movie ()
    {
        return $this->belongsToMany(Movie::class, 'movie_plays', 'id', 'movie_id');
    }
}
