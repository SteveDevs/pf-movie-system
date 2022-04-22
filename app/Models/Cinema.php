<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    public function theaters ()
    {
        return $this->hasMany(Theater::class);
    }

    public function plays ()
    {
        return $this->hasManyThrough(MoviePlay::class, Theater::class);
    }
}
