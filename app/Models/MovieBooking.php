<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieBooking extends Model
{
    protected $fillable = ['movie_play_id', 'unique_ref'];
    public function movie ()
    {
        return $this->belongsToMany(Movie::class, 'movie_plays', 'movie_play_id', 'movie_id');
    }
}
