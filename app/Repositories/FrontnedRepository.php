<?php


namespace App\Repositories; 

 
use App\Concert;
use App\Article;
use App\City;
use App\User;
use App\Vet;
use App\Comment;
use App\Clinic;
use App\Reservation;
use Illuminate\Support\Facades\Auth;

class FrontendRepository {  
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;
  

    
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
      $results =City::with(['vets.photos','vets.comments','clinics.photos'])->where('name',$city)->first() ?? false; 
        return  $results;
      
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

    public function getSiteClinic($clinic_id)
    {

      $Clinic= Clinic::with('comments.user','photos')->find($clinic_id);

         return $Clinic;   
                    
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

     
        
        $commentable = $type::find($commentable_id);
        
        $comment = new Comment;
 
        $comment->content = $request->input('content');

        $comment->rating = $type == 'App\Vet'||'App\Clinic' ? $request->input('rating') : 0;

        $comment->user_id = $request->user()->id;
        
        return $commentable->comments()->save($comment);
    }
    


    public function getReservationsByVetId( $vet_id )
    {
        return  Reservation::where('vet_id',$vet_id)->get(); 
    } 


    public function saveReservation($request, $vet_id)
    {
        $date = $request->data;
        $newDate = date('d-m-Y', strtotime($date ));
        return Reservation::create([
                'day'=>$request->data,
                'hour'=>$request->godzina,
                'status'=>0,
                'user_id'=>Auth::user()->id,
                'vet_id'=>$vet_id,
                            ]);
    }
}


