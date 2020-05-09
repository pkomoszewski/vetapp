<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['imie','gatunek','owner_id'];
  
    

    public function owners(){
        return $this->hasOne('App\Owner');

    }
}
