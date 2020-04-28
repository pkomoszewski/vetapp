<?php
namespace App\Presenters;


trait VetPresenter {
    

    
    public function getLinkAttribute()
    {
        return route('sitevet',['id'=>$this->id]);
    }
    
    public function getTypeAttribute()
    {
        return 'Weterynarz: '.$this->imie.' '.$this->Nazwisko;
    }
    
}