<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    protected static function boot()
    {
        parent::boot();

      
    }
     
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   

    public function concerts()
    {
        return $this->belongsToMany(Concert::class)->withTimestamps();
    }

    
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }


    

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function hasRole($role){
    if($this->roles()->where('typ',$role)->first()){

        return true;
    }
        return false;
    }

    public function vets()
    {
        return $this->hasOne('App\Vet');
    }


    public function owners()
    {
        return $this->hasOne('App\Owner');
    }
   
    public function reservation(){

        return $this->hasOne('App\user');
     }
    

}
