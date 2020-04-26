<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['Imie','gatunek'];
  
    

    public function users(){
        return $this->hasOne(User::class);

    }
}
