<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;
class Vet extends Model
{
    public function cities(){
        return $this->hasOne(City::class);

    }
}
