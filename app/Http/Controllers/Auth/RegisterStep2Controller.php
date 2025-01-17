<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Validation\FormValidation;
use App\Vet;
use App\Specialization;

class RegisterStep2Controller extends Controller
{
    
  
    public function __construct(FormValidation $FormValidation)
    {
        $this->middleware('auth');
        $this->fV = $FormValidation;
    }

    public function showForm()
    {
        $vet=Vet::where('user_id',Auth::id())->first();
        $specializations=Specialization::all();
        return view('auth.register_step2_vet')->with(['vet'=>$vet,'specializations'=>$specializations]);
    }
    public function postForm(Request $request)
    {
        $vet=Vet::where('user_id',Auth::id())->first();
        $saveInfoVet = $this->fV->vadlidationFormRegisterVet($vet,$request);
        return redirect()->route('home');
    }
}
