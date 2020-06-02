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
  

    
  
    public function getIndexSite()
    {
     $comments = Comment::where('commentable_type' ,'App\Vet')->with('user.owners')->paginate(2);
    
   
        return $comments; 
    } 
    
    
    public function getIndexSiteCommentArticle()
    {
     $articlecomments = Comment::where('commentable_type' ,'App\Article')->with('user.owners')->paginate(2);
    
   
        return $articlecomments; 
    } 
    
    
    
    
    public function getListArticles()
    {
      
        return Article::paginate(10);;
    } 
    
   
    
    public function getSearchCities( string $term)
    {
      return  City::where('name', 'LIKE', $term . '%')->get();
                      
    } 
   
    public function getSearchResultsVet( string $city)
    {
   
      $city=City::where('name',$city)->first();
    
      $results =Vet::with(['photos','comments'])->where('city_id',$city->id)->get() ?? false; 

      return  $results;
      
    } 

    public function getSearchResultsClinic( string $city)
    {
      $city=City::where('name',$city)->first();
      $results =Clinic::with(['photos','comments'])->where('city_id',$city->id)->get() ?? false; 
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
      $Vet= Vet::with('comments.user','phone','photos')->find($vet_id);

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
        return  Reservation::with('owner')->where('vet_id',$vet_id)->paginate(4); 
    } 


    public function saveReservation($request, $vet_id,$owner_id)
    {
   
    

$animal=(int)$request->animal;
        $date = $request->data;
        $newDate = date('d-m-Y', strtotime($date ));
        return Reservation::create([
                'day'=>$request->data,
                'hour'=>$request->godzina,
                'status'=>0,
                'opis'=>$request->opis,
                'owner_id'=> $owner_id,
                'vet_id'=>$vet_id,
                'animal_id'=>$animal
                
                            ]);
    }




    public function confirmReservationVet($reservation_id)
    {
   
    

    $confirmReservationId=Reservation::find($reservation_id);

        if($confirmReservationId->status==0){
        $confirmReservationId->update([

          'status' => 1,
          

        ]
        
        );
        return true;
        }
        return false;
       
       }


       public function cancelReservationVet($reservation_id)
       {
      
       
   
       $confirmReservationId=Reservation::find($reservation_id);
   
           if($confirmReservationId->status==1){
           $confirmReservationId->update([
   
             'status' => 0,
             
   
           ]
           
           );
     
           return true;
           }
           return false;
          
          }




       public function getReservationByOwnerId($owner_id)
       {
         $ownerReservation= Reservation::with('owner','vet')->where('owner_id',$owner_id)->orderBy('day','asc')->paginate(2);
            return $ownerReservation;   
                       
       } 



       public function addFormRegisterVet($vet, $request)
       {
   
        
          $city= $request->input('miejscowosc');
           $vet->cena_konsulatcji	= $request->input('cena');
           $vet->opis= $request->input('opis');
           $vet->phone()->numer =$request->input('numer');
           $vet->adres= $request->input('adres');
           $vet->address_latitude= $request->input('address_latitude');
           $vet->address_longitude= $request->input('address_longitude');
           $city = City::firstOrNew(['name' => $request->input('miejscowosc')]);
           $city->save();
           $vet->city_id =$city->id;
           $vet->save();
           return $vet;
       }

       
}


