<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Concert;
use App\User;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($user_id)
    {
        $user=User::find($user_id);
        
        $orders= $user->concerts->all();
        return view('pages.user_orders', compact('orders')); 
        }
        
    public function makeOrder($concert_id,User $user)
    {
        

     $user->concerts()->syncWithoutDetaching([$concert_id]);
     return view('pages.success_order');
        }   
}
