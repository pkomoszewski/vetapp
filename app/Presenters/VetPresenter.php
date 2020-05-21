<?php
namespace App\Presenters;
use Illuminate\Support\Carbon;

trait VetPresenter {
    

    
    public function getLinkAttribute()
    {
        return route('sitevet',['id'=>$this->id]);
    }
    
    public function getTypeAttribute()
    {
        return 'Weterynarz: '.$this->imie.' '.$this->nazwisko;
    }
    
  
    public function getNameAttribute()
    {
        return $this->imie.' '.$this->nazwisko;
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