<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateways\FrontendGateway;
use App\Repositories\FrontendRepository;
use App\Repositories\BackendRepository;
use App\Validation\FormValidation;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Vet;
use App\Location;
use App\Clinic;
class FrontendController extends Controller
{
    public function index()
    {
        $comments = $this->fR->getIndexSite();
        $articleComments = $this->fR->getIndexSiteCommentArticle();
        
     return view('pages.index')->with(['comments'=>$comments,
                                      'articlecomments'=>$articleComments]);
    }

    public function __construct(FrontendGateway $frontendGateway, FrontendRepository $frontendRepository,BackendRepository $BackendRepository,FormValidation $FormValidation)
    {
        $this->fG = $frontendGateway; 
        $this->fR=$frontendRepository;
        $this->bR=$BackendRepository;
        $this->fV = $FormValidation;
    }

    public function searchCities(Request $request)
    {
        $results = $this->fG->searchCities($request);

        return response()->json($results);
    }


    public function search(Request $request)
    {
  
   if( $request->input('city') != null){
    $City=$request->input('city');
   }
        if($request->input('choose')=="Weterynarz")
        {
            if( $request->input('city') == null){
                $Result = Vet::all();
                return view('frontend.resultsSearchVet')->with(['results'=>$Result]);
               }
            $Result = $this->fG->getSearchResultsVet($request);
        
            return view('frontend.resultsSearchVet')->with(['results'=>$Result
            ,'city'=>$City]);

        }
        elseif($request->input('choose')=="Klinika")
        {
            if( $request->input('city') == null){
                $Result = Clinic::all();
                return view('frontend.resultsSearchClinic')->with(['results'=>$Result]);
               }
             $Result = $this->fG->getSearchResultsClinic($request);
                return view('frontend.resultsSearchClinic')->with(['results'=>$Result
            ,'city'=>$City]);
            
     
          
        }
     
    }


    


   
public function like($like_id, $type, Request $request)
{
    $this->fR->like($like_id, $type, $request);

  return redirect()->back();
}

public function unlike($like_id, $type, Request $request)
{
    $this->fR->unlike($like_id, $type, $request);
    return redirect()->back();
}


public function calendarVisitToUser($owner_id)
{
    // wyswietla rezerwacje dla wetrynarza
    $resrtvationsToOwner= $this->fR->getReservationByOwnerId($owner_id);
 return view('pages.calendarVisitToUser')->with(['reservations'=>$resrtvationsToOwner]);
}

public function siteCalendarvisit($user_id)
{
    $vet=Vet::where('user_id',$user_id)->first();
    $vet_id=$vet->id;

   $resrtvationsToVet= $this->fR->getReservationsByVetId($vet_id);
   

 return view('pages.calendarVisitToVet')->with(['reservations'=>$resrtvationsToVet,'vet_id'=>$vet_id]);
}

public function siteHistoryVisit($user_id)
{
    $vet=Vet::where('user_id',$user_id)->first();
    $vet_id=$vet->id;
    $resrtvationsToVet= $this->fR->getReservationsByHistoryVetId($vet_id);

 return view('pages.historyVisitToVet')->with(['reservations'=>$resrtvationsToVet,'vet_id'=>$vet_id]);
}

public function sitecancelVisit($user_id)
{
    $vet=Vet::where('user_id',$user_id)->first();
    $vet_id=$vet->id;
    $resrtvationsToVet= $this->fR->getReservationsByCancelVetId($vet_id);

 return view('pages.cancelVisitToVet')->with(['reservations'=>$resrtvationsToVet,'vet_id'=>$vet_id]);
}


public function siteReservationCalendar($vet_id,$location_id)
{

    $reservations = $this->fR->getReservationsByVetIdandLocation($vet_id,$location_id);
    $vet=Vet::find($vet_id);
    $location=Location::find($location_id);
 return view('pages.calendar')->with(['reservations'=>$reservations,'vet_id'=>$vet_id,'vet'=>$vet,'location'=>$location]);
}

public function showListArticles()
{
    $Articles = $this->fR->getListArticles();
 return view('frontend.viewListArticle')->with('results',$Articles);
}


public function siteVet($id)
{
    $vet = $this->fR->getSiteVet($id);
    
 return view('pages.siteVet')->with('vet',$vet);
}


public function siteClinic($id)
{
    $clinic = $this->fR->getSiteClinic($id);
    
 return view('pages.siteClinic')->with('clinic',$clinic);
}


public function  viewAddFormAnimal()
{
   
    
 return view('pages.addAnimal');
}


public function indexProfile(User $user){


    if(Auth::user()->hasRole(['Weterynarz'])){
     $Vet= $this->fR->getVet(Auth::id());

     return view('profiles.profileVet')->with([
     'vet'=>$Vet,
     
     'user'=>$user
     ]);

     }

    if(Auth::user()->hasRole(['Użytkownik'])){
        $Owner= $this->fR->getOwner(Auth::id());
        return view('profiles.profileOwner',['user'=>$Owner]);

    }
  
}


public function addComment($commentable_id, $type, Request $request)
    {
        $comment = $this->fV->vadlidationFormAddComment($commentable_id, $type,$request); 
        return redirect()->back();
    }







public function ViewformReservation($data,$ts,$vet_id,$location_id)
{
    $vet=Vet::find($vet_id);
    $location=Location::find($location_id);

    return view('pages.fromReservation',[
    
    'data'=>$data,
    'ts'=>$ts,
    'vet'=>$vet,
    'location'=>$location,
    ]



);
    
}

public function confirmReservation(Request $request, $vet_id)
{
    $owner_id =Auth::user()->owners->id;

    $reservation = $this->fV->vadlidationFormConfirmReservation($request, $vet_id,$owner_id);
            

    return view('pages.successReservation');
    
}
// potwierdzenie rezerwacji przez weterynarza
public function confirmReservationVet($reservation_id)
{
//walidacja

    $confirmReservationVet = $this->fR->ConfirmReservationVet($reservation_id);
            
    return redirect()->back(); 
    
}

public function cancelReservationVet($reservation_id)
{
//walidacja


    $cancelReservationVet = $this->fR-> cancelReservationVet($reservation_id);
            
    return redirect()->back(); 
    
}
 public function siteContact()
    {
    
    return view("pages.contact");
    }

public function addNewsletter(Request $request)
{


    $AddtoNewletter = $this->fR-> addNewsletter($request);
            
    return redirect()->back()->with('success', 'Zostałeś pomyślnie dodany do Newslettera');; 
    
}


}



