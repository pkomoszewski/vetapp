<?php

namespace App\Policies;

use App\User;
use App\Animal;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
*/
    public function __construct()
    {
    }

    
        public function Animal(User $user, Animal $animal){
    return $user->id==$animal->user_id;

        }
    }

