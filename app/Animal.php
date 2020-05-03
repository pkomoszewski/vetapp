<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['Imie','gatunek','user_id'];
  
    

    public function users(){
        return $this->hasOne(User::class);

    }
}
