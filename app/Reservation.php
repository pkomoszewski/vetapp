<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['day','hour','status','owner_id','vet_id','opis','animal_id',];
    public function vet(){

      return $this->belongsTo('App\Vet');
    }
 public function owner(){

    return $this->belongsTo('App\Owner');
 }

 public function Animal(){

   return $this->belongsTo('App\Animal');
}



}
