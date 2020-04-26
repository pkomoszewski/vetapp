<?php


namespace App\Repositories; 

 
use App\Concert;
use App\Article;
use App\City;
use App\User;


class FrontendRepository {  
    
  
    public function getObjectsConcerts()
    {
      
        return Concert::all(); 
    } 
     

    
    public function getObjectsArticles()
    {
      
        return Article::all(); 
    } 
    
    public function getProfile($user_id)
    {
      $user= User::with(['animals'])->find($user_id);
         return $user;   
            
            
    } 
    
    public function getSearchCities( string $term)
    {
      return  City::where('name', 'LIKE', $term . '%')->get();
                      

    } 
   
    public function getSearchResults( string $city)
    {
      
        return  City::with(['vets'])->where('name',$city)->first() ?? false; 
      
    } 
    
  
}


