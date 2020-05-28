<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BackendRepository;
use App\Validation\FormValidation;
class BackendController extends Controller
{

    public function __construct(BackendRepository $BackendRepository,FormValidation $FormValidation)
    {
        
        $this->bR=$BackendRepository;
        $this->fV = $FormValidation;

    }
    public function NewAnimal(Request $request){
  
        $add = $this->fV->vadlidationFormAddAnimal($request);
        return redirect()->back(); /// musze cos zrobic z tym
    }


    public function showHistoryTreatmeantAnimal($id){

        $histories = $this->bR->getHistoryTreatmentAnimal($id);
        $totalbill = $this->bR->sumBil($id);
        return view('pages.viewHistoryTreatmentAnimal')->with(['histories'=>$histories,'totalbill'=>$totalbill],);
 
    }


    public function showformAddArticle(){
  
        return view('backend.admin.addArticle');
    }

    public function viewSuccessSave(){
  
        return view('pages.successSave');
    }

    public function showformAddHistoryTreatmeantAnimal($animal_id){
  
        return view('backend.vet.addHistoryTreatment')->with('animal_id',$animal_id);
    }


    public function NewHistoryTreatmeantAnimal(Request $request,$id){
  
        $add = $this->fV->vadlidationFormAddHistoryTreatment($request,$id);
        return view('backend.admin.addArticle');
    }

    ////////////////
    public function showArticle($id){

        $article = $this->bR->getArticle($id);
        return view('pages.article')->with('article',$article);
    }
///////////////////////////////////Panel administrator list
    public function NewArticle(Request $request){

        $add = $this->fV->vadlidationFormAddArticle($request);
        return view('backend.admin.addArticle');
    }
   
    public function showAdminPanel(){

     $Owners=$this->bR->getOwner();
        return view('backend.admin.index')->with('owners',$Owners);
    }

    public function showAllReservations(){

        $Reservations=$this->bR->getAllReservations();
           return view('backend.admin.showAllReservation')->with('Reservations',$Reservations);
       }
///////////////////////////////////////////////////////////////////////////////
//Obsluga userów w panelu administaratora

       public function deleteUser($id){

        $deleteUser=$this->bR->deleteUser($id);
          return redirect()->back()->with('success', 'Użytkownik został usunięty');
       }
       
       public function BanUser($id){
        $BanUser=$this->bR->BanUser($id);
          return redirect()->back()->with('success', $BanUser);
       }

///////////////////////////////////////////////////////////////////////////////
//Obsluga weterynarzy na panelu administratora
   
public function showAllVet(){

    $vets=$this->bR->showAllVet();
       return view('backend.admin.showAllVet')->with('vets',$vets);
   }


}

