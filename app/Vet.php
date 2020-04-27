<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;
use Illuminate\Support\Facades\Auth;
class Vet extends Model
{
    public function cities(){
        return $this->hasOne(City::class);

    }

    public function users()
    {
        return $this->morphToMany('App\User', 'like');
    }
    
    
    public function isLiked()
    {
        return $this->users()->where('user_id',Auth::user()->id)->exists();
    }
}
