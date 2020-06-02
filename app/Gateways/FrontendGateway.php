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

    public function getSearchResultsVet($request)
    {
        $request->flash();
        if( $request->input('city') != null)
        {
            $result = $this->fR->getSearchResultsVet($request->input('city'));

            if($result)
            {
                if(count($result)> 0)
                return $result;  
                else return false;
            }

        }
        
        return false;

    }

    

    public function getSearchResultsClinic($request)
    {
        $request->flash();
        if( $request->input('city') != null)
        {
            $result = $this->fR->getSearchResultsClinic($request->input('city'));

            if($result)
            {
                if(count($result)> 0)
                return $result;  
                else return false;
            }

        }
        
        return false;

    }


}


