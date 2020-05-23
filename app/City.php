<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vet;
use App\Clinic;
class City extends Model
{
    protected $fillable = ['name'];
    public function vets(){
        return $this->hasMany(Vet::class);

    }

    public function clinics(){
        return $this->hasMany(Clinic::class);

    }
}
