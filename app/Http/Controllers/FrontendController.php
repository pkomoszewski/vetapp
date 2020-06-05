<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateways\FrontendGateway;
use App\Repositories\FrontendRepository;
use App\Repositories\BackendRepository;
use App\Validation\FormValidation;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Storage; 
use App\User;
use App\Vet;
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
   
        if($request->input('choose')=="Weterynarz")
        {

            $Result = $this->fG->getSearchResultsVet($request);
        
            return view('frontend.resultsSearchVet')->with('results',$Result);
        }
        elseif($request->input('choose')=="Klinika")
        {
             $Result = $this->fG->getSearchResultsClinic($request);
                return view('frontend.resultsSearchClinic')->with('results',$Result);
            
     
          
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



public function siteReservationCalendar($vet_id,$user_id)
{
    $reservations = $this->fR->getReservationsByVetId($vet_id);
    $vet=Vet::find($vet_id);
 return view('pages.calendar')->with(['reservations'=>$reservations,'vet_id'=>$vet_id,'vet'=>$vet],);
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

/////////////////////////////////////////////////////////////////////////////
public function profileEdit(Request $request )
{

    if ($request->isMethod('post')) 
    {


  
        if(Auth::user()->hasRole(['Weterynarz'])){
         


            $this->validate($request,[
                'imie'=>"required|string",
                'nazwisko'=>"required|string",
                'opis'=>"required|string",
                'numer'=>"integer",
                'cena'=>"string",
                'adres'=>"required|string",
              
                ]);
                $vet= $this->bR->saveVet($request);
                $numer=$request->input('numer');
                if(!$request->input('numer')==null){
                    if($vet->phone!=null){
                        $phone = $this->bR->getPhone($vet->phone->first()->id);
                   
                        $this->bR->updatePhone($vet,$phone,$numer);
                    }else{
                 
                    $this->bR->createphone($vet,$numer);
                    }
                }
                if ($request->hasFile('vetPicture'))
                {
                    $this->validate($request,[
                    'vetPicture'=>"image|max:100",
                    ]);

                    $path = $request->file('vetPicture')->store('vets', 'public');
                    if (count($vet->photos) != 0)
                    {
                        $photo = $this->bR->getPhoto($vet->photos->first()->id);
                        Storage::disk('public')->delete($photo->storagepath);
                        $photo->path = $path;
                        $this->bR->updateUserPhoto($vet,$photo);
                    } 
                    else
                    {
                        $this->bR->createVetPhoto($vet,$path);
                    }           
                }
              

                return redirect()->route('viewSucessSave');


        }else{
    
            return view('profiles.editOwner',['user'=>Auth::user()]);
        }
 
    }

    if(Auth::user()->hasRole(['Weterynarz'])){
        return view('profiles.editVet',['user'=>Auth::user()]);
    }else{

        return view('profiles.editOwner',['user'=>Auth::user()]);
    }
    
}




public function ViewformReservation($data,$ts,$vet_id)
{

    return view('pages.fromReservation',[
    
    'data'=>$data,
    'ts'=>$ts,
    'vet_id'=>$vet_id
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



