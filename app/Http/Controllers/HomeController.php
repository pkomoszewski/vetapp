<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Repositories\FrontendRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FrontendRepository $frontendRepository)
    {
        $this->fR=$frontendRepository;
        $this->middleware('auth');
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    
        return view('home');
    }


    public function articles()
    {
        $Articles= $this->fR->getObjectsArticles();

        return view('pages.articles')->with('data',$Articles);;
    }
}
