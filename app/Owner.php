<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ['imie'];
    public function animals()
    {
    
        return $this->hasMany('App\Animal');
    }
    
    public function user()
    {
    
        return $this->belongsTo('App\Animal');
    }

}
