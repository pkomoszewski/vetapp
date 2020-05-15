<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['day','hour','status','user_id','vet_id'];
    public function vets(){

       return $this->belongsToMany('App\Vet');
    }
    public function owners()
    {
        return $this->hasManyThrough('App\Owner', 'App\User',
        'owner_id', // Foreign key on users table...
            'user_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
    );
    }

}
