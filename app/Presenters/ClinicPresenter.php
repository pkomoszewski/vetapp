<?php
namespace App\Presenters;
use Illuminate\Support\Carbon;

trait ClinicPresenter {
    

    
    public function getLinkAttribute()
    {
        return route('siteClinic',['id'=>$this->id]);
    }
    
    public function getTypeAttribute()
    {
        return 'Klinika: '.$this->name;
    }
    
  
 


    public function averageRating()
    {
       $result=  $this->comments()->avg('rating');
        return round( $result);
    }

    public function getTimeStartAttribute()
    {    
        return \Carbon\Carbon::createFromFormat('H:i:s',$this->godzina_otwarcia)->format('H:i');
    }
    public function getTimeEndAttribute()
    {
        return \Carbon\Carbon::createFromFormat('H:i:s',$this->godzina_zamkniecia)->format('H:i');
    }
    

} 