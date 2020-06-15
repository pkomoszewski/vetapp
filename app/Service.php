<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Isset_;

class Service extends Model
{
    public $timestamps = false;
      
    protected $casts = [
        'services' => 'array'
    ];
    public function serviceable()
    {
        return $this->morphTo();
    }


    public function setServicesAttribute($value)
{
    $services = [];
  
    foreach ($value as $array_item) {
        
        if (array_key_exists('kind',$array_item) && !is_null($array_item["kind"])) {
            $services[] = $array_item;
        }
    }

    $this->attributes['services'] = json_encode($services);
}

}
