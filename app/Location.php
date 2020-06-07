<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  
    protected $casts = [
        'whenOpen' => 'array'
    ];
    
 
   
    public function locationable()
    {
        return $this->morphTo();
    }

}
