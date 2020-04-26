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





}


