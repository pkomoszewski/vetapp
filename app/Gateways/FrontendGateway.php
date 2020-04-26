<?php

namespace App\Gateways;

use App\Repositories\FrontendRepository;


class FrontendGateway { 
    
     
  
    public function __construct(FrontendRepository $fR ) 
    {
        $this->fR = $fR;
    }
    
    
    public function searchCities($request)
    {
        $term = $request->input('term');

        $results = array();

        $queries = $this->fR->getSearchCities($term);

        foreach ($queries as $query)
        {
            $results[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $results;
    } 

    public function getSearchResults($request)
    {
        $request->flash();

        if( $request->input('city') != null)
        {

            $result = $this->fR->getSearchResults($request->input('city'));

            if($result)
            {

                // to do: filter results based on check in and check out etc.



                if(count($result->vets)> 0)
                return $result;  // filtered result
                else return false;


               // inputs for session for one request
 // filtered result




            }

        }
        
        return false;

    }



}


