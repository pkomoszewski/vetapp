<?php


namespace App\Repositories; 

 
use App\Concert;
use App\Article;
use App\City;
use App\User;
use App\Vet;
use App\Comment;

class FrontendRepository {  
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;
    public function getObjectsConcerts()
    {
      
        return Concert::all(); 
    } 
     

    
    public function getObjectsArticles()
    {
      
        return Article::all(); 
    } 
    
   
    
    public function getSearchCities( string $term)
    {
      return  City::where('name', 'LIKE', $term . '%')->get();
                      

    } 
   
    public function getSearchResults( string $city)
    {
      
        return  City::with(['vets'])->where('name',$city)->first() ?? false; 
      
    } 
    
    public function like($like_id, $type, $request)
    {
        $like = $type::find($like_id);
      
        return $like->users()->attach($request->user()->id);
    }
    
   
    public function unlike($like_id, $type, $request)
    {
        $like = $type::find($like_id);
      
        return $like->users()->detach($request->user()->id);
    }

    public function getSiteVet($vet_id)
    {

        // moze byc do poprawy
      $Vet= Vet::with('comments.user','photos')->find($vet_id);

         return $Vet;   
                    
    } 

    public function getVet($vet_id)
    {

        // moze byc do poprawy
      $Vet= Vet::with('comments.user','phone')->find($vet_id);

         return $Vet;   
                    
    } 
    public function getOwner($user_id)
    {

       
      $user= User::with(['comments.commentable','owners'])->where('id',$user_id)->first()??false;
         return $user;   
            
            
    } 


    public function addComment($commentable_id, $type, $request)
    {

        $this->validate($request,[
            'content'=>"required|string"
        ]);
        
        $commentable = $type::find($commentable_id);
        
        $comment = new Comment;
 
        $comment->content = $request->input('content');

        $comment->rating = $type == 'App\Vet' ? $request->input('rating') : 0;

        $comment->user_id = $request->user()->id;
        
        return $commentable->comments()->save($comment);
    }
    
}


