<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Presenters\ArticlePresenter; 
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }


    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
