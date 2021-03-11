<?php


namespace App\Repositories; 

 

use App\Article;
use App\City;
use App\User;
use App\Vet;
use App\Comment;
use App\Clinic;
use App\Reservation;
use App\Newsletter;
use App\Phone;
use App\Location;
use App\Service;
use App\Specialization;
use Illuminate\Support\Carbon;
class FrontendRepository {  
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;
  

    
  
    public function getIndexSite()
    {
     $comments = Comment::where('commentable_type' ,'App\Vet')->with('user.owners')->paginate(3);
    
   
        return $comments; 
    } 
    
    
    public function getIndexSiteCommentArticle()
    {
     $articlecomments = Comment::where('commentable_type' ,'App\Article')->with('user.owners')->paginate(3);
    
   
        return $articlecomments; 
    } 
    
    
    
    
    public function getListArticles()
    {
      
        return Article::paginate(10);
    } 
    
   
    
    public function getSearchCities( string $term)
    {
      return  City::where('name', 'LIKE', $term . '%')->get();
                      
    } 
   
    public function getSearchResultsVet( string $city)
    {
   
      $city=City::where('name',$city)->first();
    if(request('sortby')=='Ilości Opinii'){
      $results =Vet::with(['photos','comments','locations'])->withCount('comments')->orderBy('comments_count', 'desc')
      ->wherehas('locations',function($query) use($city){
        $query->where('city_id','=',$city->id);
      } )->get() ?? false;
    }
    if(request('sortby')=='Cena'){
      $results =Vet::with(['photos','comments','locations'])
      ->wherehas('locations',function($query) use($city){
        $query->where('city_id','=',$city->id);
      } )->when(request('sortby')=="Cena", function($query) {
      return $query->orderBy('cena_konsulatcji', 'asc');
      })->get() ?? false; 
    }
    if(request('sortby')==null){
      $results =Vet::with(['photos','comments','locations'])->wherehas('locations',function ($query) use($city)  {
        $query->where('city_id','=',$city->id);
    })->get() ?? false;
  }

      return  $results;
      
    } 

    public function getSearchResultsClinic( string $city)
    {
      $city=City::where('name',$city)->first();
        if(request('sortby')=='ilość komentarzy'){
      $results =Clinic::with(['photos','comments','location'])->where('location.city_id',$city->id,'status',1)
          ->when(request('sortby')=="Opinie",function($query){
          return $query->orderBy('comments_count','asc');
          }) ->get() ?? false; }
                 
                 
           if(request('sortby')=='ilość polubień'){
      $results =Clinic::with(['photos','comments','location'])->wherehas('locationcity_id',$city->id,'status',1)
          ->when(request('sortby')=="ilość polubień",function($query){
          return $query->orderBy('likable_count','asc');
          })->get() ?? false; }       
                 
          if(request('sortby')==null){
      
            $results =Clinic::with(['photos','comments','location'])->wherehas('location',function ($query) use($city)  {
              $query->where('city_id','=',$city->id);
          })->where('status', 1)->get() ?? false;
 

          }
      
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
      $Vet= Vet::with('comments.owner','photos','locations')->find($vet_id);

         return $Vet;   
                    
    } 

    public function getSiteClinic($clinic_id)
    {

      $Clinic= Clinic::with('comments.owner','photos')->find($clinic_id);

         return $Clinic;   
                    
    } 



    public function getVet($vet_id)
    {

      $Vet= Vet::with('comments.user','phone','photos','locations')->where('user_id',$vet_id)->first()??false;

         return $Vet;   
                    
    } 
    public function getOwner($user_id)
    {

       
      $user= User::with(['owners'])->where('id',$user_id)->first()??false;
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

      if(request('sortby')=='Daty wizyty'){
      
        $VetReservation= Reservation::with('owner')->where('vet_id',$vet_id)->where('day', '>=', Carbon::today()->toDateString())->where('cancel',0)->orderBy('day','asc')->get();
           return $VetReservation;   
       }   
       if(request('sortby')=='Domyślny'|| request('sortby')==null){
       
         $VetReservation= Reservation::with('owner')->where('vet_id',$vet_id)->where('day', '>=', Carbon::today()->toDateString())->where('cancel',0)->get();
            return $VetReservation;   
        }  
        if(request('sortby')=='Potwierdzone'){
         $VetReservation= Reservation::with('owner',)->where('vet_id',$vet_id)->where('status',1)->where('day', '>=', Carbon::today()->toDateString())->get();
            return $VetReservation;   
        }
        if(request('sortby')=='Niepotwierdzone'){
          $VetReservation= Reservation::with('owner',)->where('vet_id',$vet_id)->where('status',0)->where('day', '>=', Carbon::today()->toDateString())->get();
            return $VetReservation;   
        }



       
    } 

    public function getReservationsByHistoryVetId( $vet_id )
    {

        return  Reservation::with('owner')->where('vet_id',$vet_id)->where('day', '<', Carbon::today()->toDateString())->where('cancel',0)->get(); 
    } 

    public function getReservationsByCancelVetId( $vet_id )
    {

        return  Reservation::with('owner')->where('vet_id',$vet_id)->where('cancel',1)->get(); 
    } 

    public function getReservationsByVetIdandLocation( $vet_id,$location_id )
    {
      $resr= Reservation::with('location')->where('vet_id',$vet_id)->where('location_id',$location_id)->get(); 
    
        return $resr;
    } 

    public function saveReservation($request, $vet_id,$owner_id)
    {
   
    

$animal=(int)$request->animal;
$phone= new Phone;
$phone->numer=$request->input('numer');



       $location_id=(int)($request->location);
       $Reservation = Reservation::create([
        'day'=>$request->data,
        'hour'=>$request->godzina,
        'status'=>0,
        'description'=>$request->opis,
        'owner_id'=> $owner_id,
        'vet_id'=>$vet_id,
        'animal_id'=>$animal,
        'location_id'=>$location_id
        
                    ]);
                    $Reservation->phone()->save($phone);
       return $Reservation;
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
      
       
   
       $cancelreservation=Reservation::find($reservation_id);

           if($cancelreservation->cancel==0){
           $cancelreservation->update([
   
             'cancel' => 1,
             
   
           ]
           
           );
     
           return true;
           }
           dd("siemka");
           return false;
          
          }

public function  addNewsletter($request){

  $this->validate($request, [
    'email' => 'required|email',

]);

$addNew = New Newsletter;
$addNew ->email=$request->input('email');


return $addNew->save(); 


}


       public function getReservationByOwnerId($owner_id)
       {
        if(request('sortby')=='Daty wizyty'){
         $ownerReservation= Reservation::with('owner','vet')->where('owner_id',$owner_id)->orderBy('day','asc')->get();
            return $ownerReservation;   
        }   
        if(request('sortby')=='Domyślny'|| request('sortby')==null){
          $ownerReservation= Reservation::with('owner','vet')->where('owner_id',$owner_id)->get();
             return $ownerReservation;   
         }  
         if(request('sortby')=='Potwierdzone'){
          $ownerReservation= Reservation::with('owner','vet')->where('owner_id',$owner_id)->where('status',1)->get();
             return $ownerReservation;   
         }
         if(request('sortby')=='Niepotwierdzone'){
          $ownerReservation= Reservation::with('owner','vet')->where('owner_id',$owner_id)->where('status',0)->get();
             return $ownerReservation;   
         }

       } 



       public function addFormRegisterVet($vet, $request)
       {
   
           $vet->cena_konsulatcji	= $request->input('cena');
           $vet->description= $request->input('opis');
        
           if(!$request->input('interval')==""){

            $int = (int)$request->input('interval');
          
            $vet->time_visit= $int ;
           }else{
            $vet->time_visit= 30;
           }
           if($request->input('visits')=="true"){
            $vet->homevisit= 1;
           }

           $city = City::firstOrNew(['name' => $request->input('miejscowosc')]);
           $city->save();
           $vet->save();
           $speces= request('specializations');
           if(!$speces==null){
           foreach($speces as $spec){
            $sp=Specialization::select('id')->where('name',$spec)->first();
            $vet->specializations()->attach($sp);

           }}
           $phone= new Phone;
           $phone->numer=$request->input('numer');
           $vet->phone()->save($phone);

          $location = new Location;
          $location->city_id= $city->id;
          $location->address=$request->input('adres');
          $location->address_latitude= $request->input('address_latitude');
          $location->address_longitude= $request->input('address_longitude');
          $location->whenOpen=request('whenOpen');
          $vet->locations()->save($location);

          $services=new Service;
          $services->services=request('services');
          $vet->service()->save($services);
       
           return $vet;
       }

       
}


