<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateways\FrontendGateway;
use App\Repositories\FrontendRepository;
use App\Repositories\BackendRepository;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Storage; 
use App\User;
class FrontendController extends Controller
{


    public function __construct(FrontendGateway $frontendGateway, FrontendRepository $frontendRepository,BackendRepository $BackendRepository)
    {
        $this->fG = $frontendGateway; 
        $this->fR=$frontendRepository;
        $this->bR=$BackendRepository;
    }

    public function searchCities(Request $request)
    {
        $results = $this->fG->searchCities($request);

        return response()->json($results);
    }


    public function vetsearch(Request $request)
    {
    
        if($Vets = $this->fG->getSearchResults($request))
        {
     
            return view('frontend.resultsSearchVet',['Vets'=>$Vets]);
        }
        else
        {
            return redirect('/')->with('norooms', __('No offers were found matching the criteria'));
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



public function siteVet($id)
{
    $vet = $this->fR->getSiteVet($id);
    
 return view('pages.siteVet')->with('vet',$vet);
}



public function  viewAddFormAnimal()
{
   
    
 return view('form.addAnimal');
}


public function index(User $user){


    if(Auth::user()->hasRole(['Weterynarz'])){
     $Vet= $this->fR->getVet($user->vets->id);
     return view('profiles.profileVet')->with([
     'vet'=>$Vet,
     'user'=>$user
     ]);

     }

     //do wstawienia middalware w celu ochrony
    

     $Owner= $this->fR->getOwner($user->id);


return view('profiles.profileOwner',['user'=>$Owner]);
}


public function addComment($commentable_id, $type, Request $request)
    {
        $this->fR->addComment($commentable_id, $type, $request);
        
      
        
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
              

                return redirect()->back(); 


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
 


}



