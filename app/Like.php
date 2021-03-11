<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function commentable()
    {
        return $this->morphTo();
    }
    public function owners()
    {
        return $this->belongsTo('App\Owners');
    }
}
