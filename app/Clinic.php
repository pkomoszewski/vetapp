<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Clinic extends Model
{

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
}

