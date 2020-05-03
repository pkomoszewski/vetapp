<?php


namespace App\Repositories; 

 
use App\Concert;
use App\Article;
use App\Animal;
use App\User;
use App\Vet;
use App\Photo;
use App\Phone;

class BackendRepository {  
    
    use \Illuminate\Foundation\Validation\ValidatesRequests;

    public function getAnimal($id)
    {
        return Animal::find($id);
    }
            
    
public function deleteAnimal(Animal $Animal)
{
    return $Animal->delete();
}
   


public function addNewAnimal($request, $id){


    $this->validate($request,[
        'imie'=>"required|min:3",
        'gatunek'=>"required|min:3",
    ]);

return Animal::create([
    'Imie'=> $request->input('imie'),
    'gatunek'=>$request->input('gatunek'),
    'user_id' => $request->user()->id,
]);

}

public function saveVet($request)
{
    $vet = Vet::find($request->user()->id);
    $vet->imie = $request->input('imie');
    $vet->nazwisko = $request->input('nazwisko');
    $vet->opis = $request->input('opis');
    $vet->cena_konsultacji = $request->input('cena');
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
}
  



