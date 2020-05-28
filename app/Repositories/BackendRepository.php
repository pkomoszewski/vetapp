<?php


namespace App\Repositories; 

 
use App\Concert;
use App\Article;
use App\Animal;
use App\User;
use App\Vet;
use App\Photo;
use App\Phone;
use App\Owner;
use App\Role;
use App\Reservation;
use App\TreatmentHistory;
use Illuminate\Support\Facades\Auth;
class BackendRepository {  
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;

    public function getAnimal($id)
    {
        return Animal::find($id);
    }
            
    public function getHistoryTreatmentAnimal($id)
    {
        return TreatmentHistory::where('animal_id',$id)->get();
    }
    
    public function sumBil($id)
    {

        $result = TreatmentHistory::where('animal_id',$id)->sum('rachunek');

        return  $result;
    }

    public function getArticle($id)
    {


        return Article::with('comments.user','photos')->find($id);
    }

////////////////////////////////////////////////////////////////////
    public function deleteUser($id)
    {
        $User=User::find($id);
        return $User->delete();
    }
  //blokowanie i odblokowywanie uzytkownikow
    public function banUser($id)
    {
        $User=User::find($id);
        $message='';
            if( $User->ban)
            {
                $User->ban=false; 

                $message="Użytkownik został odblokowany";
            }else{

                $User->ban=true;
                
                $message="Użytkownik został zablokwany";
            }
                    
            $User->save();
            return $message;
        
    }
////////////////////////////////////////////////////////
//Obsluga widoku admina weterynarz
public function showAllVet()
{
 
    $Vets =Role::with('users.vets.phone',) -> where ('typ', 'Weterynarz') -> get();
    return $Vets;
}

////////////////////////////////////////////////////do przemyslenia troche douzo
public function deleteAnimal(Animal $Animal)
{
    return $Animal->delete();
}
   
public function getOwner()
{
    $Owners =Role::with('users.owners') -> where ('typ', 'Użytkownik') -> get();
    return $Owners;
}


public function getAllReservations()
{
    $Reservations =Reservation::with('owner','animal')->get();
    return $Reservations;
}

public function addNewAnimal($request){

    $user_id= Auth::user()->id;
    $owner= Owner::where('user_id',$user_id)->first();


    $animal = Animal::create([
        'imie'=>$request->input('imie'),
        'gatunek'=> $request->input('gatunek'),
        'owner_id'=> $owner->id,
    ]);
    $animal->save();
    return $animal;

}


public function AddHistoryTreatmentAnimal($request,$id){

  


    $newTreatmentHistory = TreatmentHistory::create([
        'opis'=>$request->input('opis'),
        'weterynarz'=> Auth::user()->vets->name,
        'rachunek'=> $request->input('cena'),
        'animal_id'=> $id,
    ]);
    $newTreatmentHistory->save();
    return $newTreatmentHistory;

}


public function saveVet($request)
{
    $vet = Vet::where('user_id',$request->user()->id)->first();
    $vet->imie = $request->input('imie');
    $vet->nazwisko = $request->input('nazwisko');
    $vet->opis = $request->input('opis');
    $vet->cena_konsulatcji = $request->input('cena');
    $vet->godzina_otwarcia = $request->input('godzina_otwarcia');
    $vet->godzina_zamkniecia = $request->input('godzina_zamkniecia');
    $vet->adres = $request->input('adres');
    $vet->phone()->number =$request->input('numer');
    $vet->save();

    return $vet;
}



public function addHistoryTreatmenatAnimal($request)
{
    $vet = Vet::where('user_id',$request->user()->id)->first();
    $vet->imie = $request->input('imie');
    $vet->nazwisko = $request->input('nazwisko');
    $vet->opis = $request->input('opis');
    $vet->cena_konsulatcji = $request->input('cena');
    $vet->godzina_otwarcia = $request->input('godzina_otwarcia');
    $vet->godzina_zamkniecia = $request->input('godzina_zamkniecia');
    $vet->adres = $request->input('adres');
    $vet->phone()->number =$request->input('numer');
    $vet->save();

    return $vet;
}



public function createVetPhoto($vet,$path)
{
    $photo = new Photo;
    $photo->path = $path;
    $vet->photos()->save($photo);
}

public function createArticlePhoto($article,$path)
{
    $photo = new Photo;
    $photo->path = $path;
    $article->photos()->save($photo);
}

public function createPhone($vet,$numer)
{
    $phone = new Phone;
    $phone->numer = $numer;
    $vet->phone()->save($phone);
}
   
public function getPhone($id)
{
    return Phone::find($id);
}

public function updatePhone(Vet $vet, $phone,$numer)
{
    return  $vet->phone->update(['numer'=> $numer,]);
}


public function getPhoto($id)
{
    return Photo::find($id);
}

public function updateUserPhoto(Vet $vet,Photo $photo)
{
    return $vet->photos()->save($photo);
}

public function addArticle($request)
{

    $article= new Article;
    $article->title=$request->input('title');
    $article->content=$request->input('content');
    $article->save();
    if ($request->hasFile('articlePicture')){

        $path = $request->file('articlePicture')->store('article', 'public');
        $this->createArticlePhoto($article,$path);
    }
    return  true;
}

}
  



