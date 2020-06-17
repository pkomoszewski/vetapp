<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Isset_;

class Service extends Model
{
    public $timestamps = false;
    protected $fillable = ['services'];
    protected $casts = [
        'services' => 'array'
    ];
    public function serviceable()
    {
        return $this->morphTo();
    }



}
