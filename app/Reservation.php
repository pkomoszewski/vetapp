<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['day','hour','status','user_id','vet_id'];
    public function vets(){

       return $this->belongsToMany('App\Vet');
    }
}
