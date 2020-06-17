<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  
    
    use Presenters\LocationPresenter; 
    protected $fillable = ['address','whenOpen','city_id','address_longitude','address_latitude'];
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
