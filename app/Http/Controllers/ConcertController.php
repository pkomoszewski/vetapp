<?php

namespace App\Http\Controllers;

use App\Repositories\FrontendRepository;

class ConcertController extends Controller
{
    public function __construct(FrontendRepository $frontendRepository)
    {
        $this->fR=$frontendRepository;
    }
    public function index()
    {
        $Concerts= $this->fR->getObjectsConcerts();
        return view('pages.concerts')->with('name',$Concerts);
    }

}
