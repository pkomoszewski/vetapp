<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Owner;
use App\Specialization;
use App\Vet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    
    protected function redirectTo()
{
   
    if(Auth::user()->hasRole('Weterynarz')){
        $vet=Vet::find(Auth::id());
    
        return route('register-step2');
    }
    return route('home');
}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationVetForm()
    {
        return view('auth.register_vet');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function registerVet(Request $request)
    {
        $this->validatorVet($request->all())->validate();

        event(new Registered($user = $this->createVet($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'imie' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'regulamin' =>'accepted',
            
        ]);
    }

    protected function validatorVet(array $data)
    {
        return Validator::make($data, [
          
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'imie' => ['required', 'string', 'max:50'],
            'nazwisko' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'regulamin' =>'accepted',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user=User::create([
          
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
$role=Role::select('id')->where('typ','Użytkownik')->first();


$owner = $user->onwners ?: new Owner;
$owner->imie = $data['imie'];
$user->owners()->save($owner);

$user->roles()->attach($role);
return $user;
        
    }


    protected function createVet(array $data)
    {
        $user=User::create([
          
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
             
        ]);
$role=Role::select('id')->where('typ','Weterynarz')->first();

$vet = $user->vets ?: new Vet;
$vet->imie = $data['imie'];
$vet->nazwisko = $data['nazwisko'];
$user->vets()->save($vet);
$user->roles()->attach($role);
return $user;
        


    }


   

}
