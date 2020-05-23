<?php
namespace App\Presenters;
use Illuminate\Support\Carbon;

trait ArticlePresenter {
    

    
    public function getLinkAttribute()
    {
        return route('showArticle',['id'=>$this->id]);
    }
    
    public function getTypeAttribute()
    {
        return 'Tytuł: '.$this->title;
    }
    


    public function averageRating()
    {
       $result=  $this->comments()->avg('rating');
        return round( $result);
    }

    public function getTimeCreatedAttribute()
    {    
  
        return $this->created_at->format('d-m-Y');
    }
    

}