<?php
namespace App\Presenters;
use Illuminate\Support\Carbon;

trait OwnerPresenter {
    

    
    public function getLinkAttribute()
    {
        return route('showArticle',['id'=>$this->id]);
    }
 
    



    public function getTimeCreatedAttribute()
    {    
  
        return $this->created_at->format('d-m-Y');
    }
    

}