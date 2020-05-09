<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;
use Illuminate\Support\Facades\Auth;

class Vet extends Model
{

    use Presenters\VetPresenter; 
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


    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }



    public function phone()
    {
        return $this->morphOne('App\Phone', 'phoneable');
    }

    public function reservations(){

        return $this->belongsToMany('App\Reservation');
     }
}