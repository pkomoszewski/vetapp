<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BackendRepository;
use App\Repositories\FrontendRepository;
use App\Validation\FormValidation;
use App\User;
use App\Vet;
use App\Clinic;
use App\Owner;
use App\Comment;
class BackendController extends Controller
{

    public function __construct(BackendRepository $BackendRepository,FormValidation $FormValidation,FrontendRepository $FrontendRepository)
    {
        
        $this->bR=$BackendRepository;
        $this->fR=$FrontendRepository;
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
    public function newArticle(Request $request){

  if($request->isMethod('post')){
    $add = $this->fV->vadlidationFormAddArticle($request);
   return redirect()->Route('allArticle')->with('success', 'Artykuł został dodany');
  }
        
  
  
        return view('backend.admin.addArticle');
    }

    public function newClinic(Request $request){

        if($request->isMethod('post')){
          $add = $this->fV->vadlidationFormAddClinic($request);
         return redirect()->Route('allArticle')->with('success', 'Klinka została dodana ');
        }
              
        
        
              return view('backend.vet.addClinic');
          }   
//////////////////////////////////////////////////// 
   
    public function showAdminPanel(){

     $Owners=$this->bR->getOwner();
        return view('backend.admin.index')->with('owners',$Owners);
    }
/////////////////////////////////////////////////////////////////////////////

    public function showAllReservations(){

        $Reservations=$this->bR->getAllReservations();
           return view('backend.admin.showAllReservation')->with('reservations',$Reservations);
       }

       public function showAllClinics(){

        $Clinics=$this->bR->getAllClinics();
           return view('backend.admin.showAllClinic')->with('clinics',$Clinics);
       }


       public function deleteSelf(Request $request){


        $id=$request->input('delete_id');
        $deleteUser=$this->bR->deleteUser($id);
          return redirect()->route('register');;
       }   
///////////////////////////////////////////////////////////////////////////////
//Obsluga userów w panelu administaratora

       public function deleteUser(Request $request){


        $id=$request->input('delete_id');
        $deleteUser=$this->bR->deleteUser($id);
          return redirect()->back()->with('success', 'Użytkownik został usunięty');
       }
       
       public function banUser($id){
        $BanUser=$this->bR->BanUser($id);
          return redirect()->back()->with('success', $BanUser);
       }
//////////////////////////////////////////////////////////////////////////
//////obsluga klinic
       public function changeStatusClinic($id){
        $statusClinic=$this->bR->changeStatusClinic($id);
          return redirect()->back()->with('success', $statusClinic);
       }

       public function deleteClinic(Request $request){

        $id=$request->input('delete_id');
        $deleteClinic=$this->bR->deleteClinic($id);
          return redirect()->back()->with('success', 'Klinika został usunięta');
       }
/////////////////////////////////////////////////////////
///obsluga rezerwacji


public function deleteReservation(Request $request){

    $id=$request->input('delete_id');
    $deleteReservation=$this->bR->deleteReservation($id);
      return redirect()->back()->with('success', 'Rezerwacja został usunięta');
   }


  


///////////////////////////////////////////////////////////////////////////////
//Obsluga weterynarzy na panelu administratora
   
public function showAllVet(){

    $vets=$this->bR->showAllVet();
       return view('backend.admin.showAllVet')->with('vets',$vets);
   }

   public function getListArticles(){
///////////////////////////////////////////////////////////////////////////////
//Obsluga artykulu na panelu administratora
    $articles=$this->fR->getListArticles();
       return view('backend.admin.showAllArticle')->with('articles',$articles);
   }

   public function deleteArticle(Request $request){

    $deleleArticle=$this->bR->deleteArticle($request);
      return redirect()->back()->with('success', 'Artykuł został usunięty');
   }
public function showEditArticle($id){

      $article=$this->bR->getArticle($id);
            return view('backend.admin.editArticle')->with('article',$article);

}



public function saveEditArticle(Request $request,$id){
            
    $edit = $this->bR->editArticle($request,$id);
    return redirect()->Route('allArticle')->with('success', 'Artykuł został pomyślnie edytowany');

}


public function showSiteStatic(){
            
  $countUser=User::all()->count();
  $countVet=Vet::all()->count();
  $countClinic=Clinic::all()->count();
  $countOwner=Owner::all()->count();
  $countComment=Comment::all()->count();
    
    return view('backend.admin.showAllStatic')->with(['countUser'=>$countUser,
                                                    'countVet'=>$countVet,
                                                    'countClinic'=>$countClinic,
                                                    'countOwner'=>$countOwner,
                                                    'countComment'=>$countComment]);

}

}
