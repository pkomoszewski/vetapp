<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateways\FrontendGateway;
use App\Repositories\FrontendRepository;

use SebastianBergmann\Environment\Console;

class FrontendController extends Controller
{


    public function __construct(FrontendGateway $frontendGateway, FrontendRepository $frontendRepository)
    {
        $this->fG = $frontendGateway; 
        $this->fR=$frontendRepository;

    }

    public function searchCities(Request $request)
    {
        $results = $this->fG->searchCities($request);

        return response()->json($results);
    }


    public function vetsearch(Request $request)
    {
    
        if($Vets = $this->fG->getSearchResults($request))
        {
     
            return view('frontend.resultsSearchVet',['Vets'=>$Vets]);
        }
        else
        {
            return redirect('/')->with('norooms', __('No offers were found matching the criteria'));
        }
        
    }
public function like($like_id, $type, Request $request)
{
    $this->fR->like($like_id, $type, $request);

  return redirect()->back();
}

public function unlike($like_id, $type, Request $request)
{
    $this->fR->unlike($like_id, $type, $request);
    return redirect()->back();
}


public function siteVet($id)
{
    $User = $this->fR->getSiteVet($id);
    
 return view('pages.siteVet')->with('User',$User);
}
}
