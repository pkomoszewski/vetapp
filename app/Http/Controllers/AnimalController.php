<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BackendRepository;
use App\User;


class AnimalController extends Controller
{

    public function __construct(BackendRepository $backendRepository)
    {
        $this->bR=$backendRepository;
        $this->middleware('auth');

    }

    public function delete($animal_id)
    {
        $hasAnimal = $this->bR->getAnimal($animal_id); 

        $this->authorize('Animal', $hasAnimal);

        $this->bR->deleteAnimal($hasAnimal);
        return redirect()->back();

    }
    
    public function createAnimal(Request $request){


    }
}
