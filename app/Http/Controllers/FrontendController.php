<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateways\FrontendGateway;
use SebastianBergmann\Environment\Console;

class FrontendController extends Controller
{


    public function __construct(FrontendGateway $frontendGateway)
    {
        $this->fG = $frontendGateway; 
    }

    public function searchCities(Request $request)
    {
        $results = $this->fG->searchCities($request);

        return response()->json($results);
    }
}
