<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Clinic extends Model
{
    use Presenters\ClinicPresenter; 

    public function users()
    {
        return $this->morphToMany('App\User', 'like');
    }

    public function phone()
    {
        return $this->morphOne('App\Phone', 'phoneable');
    }
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    public function isLiked()
    {
        return $this->users()->where('user_id',Auth::user()->id)->exists();
    }

    public function vet()
    {
        return $this->belongsTo('App\Vet');
    }

    public function location()
    {
        return $this->morphOne('App\Location', 'locationable');
    }


 
}

