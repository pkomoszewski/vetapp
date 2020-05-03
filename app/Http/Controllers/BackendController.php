<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BackendRepository;
class BackendController extends Controller
{

    public function __construct(BackendRepository $BackendRepository)
    {
        
        $this->bR=$BackendRepository;

    }
    public function NewAnimal(Request $request,$id){
$id==2;
        $this->bR->addNewAnimal($request,$id);
        return redirect()->back();
    }

   
    

}
