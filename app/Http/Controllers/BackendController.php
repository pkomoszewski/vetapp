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
////////////////////////////

    public function NewArticle(Request $request){

        $add = $this->fV->vadlidationFormAddArticle($request);
        return view('backend.admin.addArticle');
    }
   
    

}
