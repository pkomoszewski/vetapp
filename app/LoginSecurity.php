<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\Event2FARegister;
class LoginSecurity extends Model
{
    protected $fillable = [
        'user_id'
    ];
    

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
