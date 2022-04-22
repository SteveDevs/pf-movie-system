<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function plays(){

        return $this->hasMany(MoviePlay::class);
    }
}
