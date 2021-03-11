<?php

namespace App\Http\Controllers;
use App\Events\Event2FA;
use App\LoginSecurity;
use Auth;
use Hash;
use Illuminate\Http\Request;

class Security2FAController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    
    public function show2faForm(Request $request){
        $user = Auth::user();
        $google2fa_url = "";
        $secret_key = "";

        if($user->LoginSecurity()->exists()){
            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeInline(
                'Vetapp',
                $user->email,
                $user->LoginSecurity->google2fa_secret
            );
            $secret_key = $user->LoginSecurity->google2fa_secret;
        }

        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'googletwofa_url' => $google2fa_url
        );

        return view('auth.2fa_settings')->with('data', $data);
    }

    /**
     * tworzy scret 2FA KEY
     */
    public function generate2faSecret(Request $request){
        $user = Auth::user();
        // Initialise the 2FA class
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        // Add the secret key to the registration data
        $login_security = LoginSecurity::firstOrNew(array('user_id' => $user->id));
        $login_security->user_id = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();

        return redirect('/2fa');
    }

    /**
     * uruchamia 2FA
     */
    public function enable2fa(Request $request){
        $user = Auth::user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $secret = $request->input('secret');
      
       
        $valid = $google2fa->verifyKey($user->loginSecurity->google2fa_secret, $secret,8);
        

        if($valid){
            $user->LoginSecurity->google2fa_enable = 1;
            $user->LoginSecurity->save();
            $status='włączona';
            Event2FA::dispatch($user,$status);
            return redirect('2fa');
        }else{
           
            return redirect('2fa');
        }
    }

    /**
     * wylacza 2FA
     */
    public function disable2fa(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
       
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::user();
        $user->LoginSecurity->google2fa_enable = 0;
        $user->LoginSecurity->save();
        $status='wyłączona';
        Event2FA::dispatch($user,$status);
        return redirect('/2fa');
    }

    
}