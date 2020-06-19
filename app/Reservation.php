<?php

namespace App;
use Cerbero\QueryFilters\FiltersRecords;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
   use FiltersRecords;
    protected $fillable = ['day','hour','status','owner_id','vet_id','opis','animal_id','location_id','cancel'];
    public function vet(){

      return $this->belongsTo('App\Vet');
    }
 public function owner(){

    return $this->belongsTo('App\Owner');
 }

 public function Animal(){

   return $this->belongsTo('App\Animal');
}
public function location(){

   return $this->belongsTo('App\location');
}

public function phone()
    {
        return $this->morphOne('App\Phone', 'phoneable');
    }


}
