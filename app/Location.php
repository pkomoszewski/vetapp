<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  
    
    use Presenters\LocationPresenter; 
    protected $casts = [
        'whenOpen' => 'array'
    ];
    
 
   
    public function locationable()
    {
        return $this->morphTo();
    }

    public function city(){
        return $this->belongsTo('App\City');

    }

    public function vet()
    {
        return $this->belongsTo('App\Vet');
    }

    

}
