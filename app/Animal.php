<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['id','imie','gatunek','owner_id'];
  
    

    public function owners(){
        return $this->hasOne('App\Owner');

    }

    public function Treatmenthistories(){
        return $this->hasMany('App\TreatmentHistory');

    }

}
