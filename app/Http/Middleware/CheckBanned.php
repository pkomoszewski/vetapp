<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth()->check() && auth()->user()->ban==true) {
           
            auth()->logout();

   
                $message = 'Twoje konto zostało zablokowane przez administratora.';
  
              
            

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);

       
    }
}
