<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Repositories\FrontendRepository;

use App\User;
class ProfilesController extends Controller
{

    public function __construct(FrontendRepository $frontendRepository)
    {
        $this->fR=$frontendRepository;
    }

public function index(User $user){

    if(Auth::user()->hasRole(['Weterynarz'])){
     $Vet= $this->fR->getVet($user->vets->id);
     return view('profiles.profileVet')->with([
     'vet'=>$Vet,
     'user'=>$user
     ]);

     }
    $this->authorize('view', $user->profile);
     $Profile= $this->fR->getProfile($user->id);


return view('profiles.profile',['user'=>$Profile]);
}


    public function edit(User $user)
    {
    
        $this->authorize('update', $user->profile);
       
        return view('profiles.edit', compact('user'));
    }
    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            
            'description' => 'required',
            'url' => '',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');           
        

        auth()->user()->profile->update([

            'opis' => $data['description'],
            'image'=> $imagePath,

        ]
           
        );
    }
    auth()->user()->profile->update([

        'opis' => $data['description'],
        

    ]
       
    );
        return redirect('profile/' . auth()->user() ->id);
    }
}
