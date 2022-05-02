<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function cinema ()
    {
        return $this->hasOne(Cinema::class, 'cinema_id');
    }
}
