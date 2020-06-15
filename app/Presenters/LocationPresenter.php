<?php
namespace App\Presenters;


trait LocationPresenter {
    

    
    public function getLinkvetAttribute()
    {
        return route('siteVet',['id'=>$this->locationable_id]);
    }
    

    



    public function getTimeCreatedAttribute()
    {    
  
        return $this->created_at->format('d-m-Y');
    }
    

}