<?php

namespace App\Validation;
use App\Validation\FormValidation;
use App\Repositories\FrontendRepository;
use App\Repositories\BackendRepository;

class FormValidation{ 
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;
  
    public function __construct(FrontendRepository $fR,BackendRepository $bR ) 
    {
        $this->fR = $fR;
        $this->bR = $bR;
    }
    
    
  
    public function vadlidationFormConfirmReservation($request,$vet_id)
    {
        $this->validate($request,[
        'imie'=>"required|string",
        'nazwisko'=>"required|string",
        'numer'=>"required|integer",
        'opis'=>"required|string",
        'data'=>"required|string",
        'godzina'=>"required|string",


        ]);
        
        
        
        return $this->fR->saveReservation($request,$vet_id);
    }


 
    public function vadlidationFormAddAnimal($request)
    {
        $this->validate($request,[
        'imie'=>"required|string",
        'gatunek'=>"required|string",

        ]);
        
        
        
        return $this->bR->addNewAnimal($request);
    }
    
 
    public function vadlidationFormAddComment($commentable_id, $type, $request)
    {
        $this->validate($request,[
        'content'=>"required|string",
    

        ]);
        
        
        
        return    $this->fR->addComment($commentable_id, $type, $request);
    }


}


