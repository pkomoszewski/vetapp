<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use Presenters\OwnerPresenter; 
    protected $fillable = ['imie','owner_id'];
    public function animals()
    {
    
        return $this->hasMany('App\Animal');
    }
    
    public function user()
    {
    
        return $this->belongsTo('App\Animal');
    }

    public function photo()
    {
        return $this->morphOne('App\Photo', 'photoable');
    }
}
