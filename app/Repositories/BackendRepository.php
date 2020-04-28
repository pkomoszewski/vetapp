<?php


namespace App\Repositories; 

 
use App\Concert;
use App\Article;
use App\Animal;
use App\User;


class BackendRepository {  
    
    

    public function getAnimal($id)
    {
    
        return Animal::find($id);
}
            
    
public function deleteAnimal(Animal $Animal)
{
    return $Animal->delete();
}
   


public function createAnimal($request, $user_id){

return Animal::create([
    'Imie'=> $request->input('imie'),
    'gatunek'=>$request->input('gatunek'),
    'user_id'=>$user_id
]);

} 
    
   
}
  



