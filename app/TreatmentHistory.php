<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentHistory extends Model
{
    use Presenters\HistoryTreatmentAnimalPresenter; 

    protected $fillable = ['opis','weterynarz','rachunek','animal_id','created_at'];
    protected $table = 'history_treatments';

  
  
}
