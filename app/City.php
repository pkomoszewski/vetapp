<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vet;
class City extends Model
{
    public function vets(){
        return $this->hasMany(Vet::class);

    }
}
