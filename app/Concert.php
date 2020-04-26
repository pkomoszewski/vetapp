<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
