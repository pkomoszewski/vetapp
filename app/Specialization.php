<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    public function vets()
    {
        return $this->belongsToMany('App\Vet');
    }
    
}
