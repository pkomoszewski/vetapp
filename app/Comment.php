<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function commentable()
    {
        return $this->morphTo();
    }
    
    /* Lecture 16 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
  
}
