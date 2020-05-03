<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{ 
    protected $guarded = [];
    public $timestamps = false;
    public function phoneable()
    {
        return $this->morphTo();
    }
}
