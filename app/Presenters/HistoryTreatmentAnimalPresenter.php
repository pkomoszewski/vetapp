<?php
namespace App\Presenters;
use Illuminate\Support\Carbon;

trait HistoryTreatmentAnimalPresenter {

    
    public function getTimeCreatedAttribute()
    {    
  
        return $this->created_at->format('d-m-Y');
    }
   

}