<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speclialization extends Model
{
    public function vets()
    {
        return $this->belongsToMany('App\Vet');
    }
}
