<?php

namespace App\Validation;

use App\Repositories\FrontendRepository;
use App\Repositories\BackendRepository;

class FormValidation{ 
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;
  
    public function __construct(FrontendRepository $fR,BackendRepository $bR ) 
    {
        $this->fR = $fR;
        $this->bR = $bR;
    }
    
    
  
    public function vadlidationFormConfirmReservation($request,$vet_id,$owner_id)
    {

        if($request->animal){


            $this->validate($request,[
                'animal'=>"required|integer",
                ]); 
                
              
        }
        $this->validate($request,[
        'imie'=>"required|string",
        'nazwisko'=>"required|string",
        'numer'=>"required|integer",
        'opis'=>"required|string",
        'data'=>"required|string",
        'godzina'=>"required|string",
        'location'=>"required|integer",


        ]);
        
        
        
        return $this->fR->saveReservation($request,$vet_id,$owner_id);
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


    public function vadlidationFormRegisterVet($vet, $request)
    {



        $this->validate($request,[
            'imie'=>"required|string",
            'nazwisko'=>"required|string",
            'adres'=>"required|string",
            'miejscowosc'=>"required|string",
            'opis'=>"required|string",
            'cena'=>"required|string",
            'numer'=>"required|integer",
         
    

        ]);
        
     
        
        return    $this->fR->addFormRegisterVet($vet, $request);
    }


    //walidacja formularza dodawanie artykulu
    public function vadlidationFormAddArticle($request)
    {
    
        if (!$request->hasFile('articlePicture'))
        {
            $this->validate($request,[
                'title'=>"required|string",
                'content'=>"required|string",
                     
            ]);
          
        }
      
        $this->validate($request,[
            'articlePicture'=>"image",
            'title'=>"required|string",
            'content'=>"required|string",
            ]);
       
     
        return    $this->bR->addArticle($request);
    }


    public function vadlidationFormAddHistoryTreatment($request,$id)
    {
   
        $this->validate($request,[
            'opis'=>"required|string",
            'cena'=>"required|integer",
            ]);

       
        return    $this->bR->AddHistoryTreatmentAnimal($request,$id);
    }
    public function vadlidationEditProfileVet($request){
        dd("siemka");
        $this->validate($request,[
            'imie'=>"required|string",
            'nazwisko'=>"required|string",
            'opis'=>"string",
            'numer'=>"integer",
            'cena'=>"string",
            'adres'=>"string",
    
          
            ]);

           
    }

    public function vadlidationFormAddClinic($id,$request){
        $this->validate($request,[
            'Nazwa'=>"required|string",
            'Email'=>"required|string",
            'opis'=>"string",
            'Numer'=>"integer",
           
          
            ]);

            //check owner
            if($id)
            
            {
                $clinic = $this->bR->updateClinic($id, $request);
            }
            else
            {
                $clinic= $this->bR->AddNewClinic($request);
             
            }
        

            if ($request->hasFile('objectPictures'))
            {
                
                $this->validate($request, \App\Photo::imageRules($request,'objectPictures')); 
                
             
                foreach($request->file('objectPictures') as $picture)
                {
                    $path = $picture->store('article', 'public');
    
                    $this->bR->createPhoto($clinic, $path);
                }
    
            }
    }
 
    public function vadlidationFormAddAddress($id, $request){
        $this->validate($request,[
            'adres'=>"required|string",
            'miejscowosc'=>"required|string",
            ]);


            if($id)
            
            {
                $this->bR->updateAddress($id, $request);
            }
            else
            {
                $this->bR->AddNewAddress($request);
             
            }
           
    }

}


