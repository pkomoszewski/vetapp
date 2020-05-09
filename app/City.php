<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vet;
use App\Clinic;
class City extends Model
{
    public function vets(){
        return $this->hasMany(Vet::class);

    }

    public function clinics(){
        return $this->hasMany(Clinic::class);

    }
}
