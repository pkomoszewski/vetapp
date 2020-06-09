<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;
use Illuminate\Support\Facades\Auth;

class Vet extends Model
{
  

    use Presenters\VetPresenter; 
    protected $fillable = ['imie','nazwisko','Vet','city_id'];
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


     public function specializations()
     {
         return $this->belongsToMany('App\Specialization');
     }

     public function Clinics(){
        return $this->hasMany('App\Clinic');

    }
    
    public function locations()
    {
        return $this->morphMany('App\Location', 'locationable');
    }


    public function service()
    {
        return $this->morphOne('App\Service', 'serviceable');
    }

   

}