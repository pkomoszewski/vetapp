@extends('main') 

@section('content') 

<div class="container">
    <h2>Dane Weterynarza</h2>
    <form method="POST" action="{{ route('profile',['user'=>Auth::user()->id]) }}" class="form-horizontal" enctype="multipart/form-data">

        @csrf
        <fieldset>
            <div class="form-group">
                <label for="imie" class="col-lg-2 control-label">imie</label>
                <div class="col-lg-10">
                    <input name="imie" type="text" required class="form-control" id="name" value="{{$user->vets->imie}}">
                </div>
            </div>
            <div class="form-group">
                <label for="nazwisko" class="col-lg-2 control-label">Nazwisko</label>
                <div class="col-lg-10">
                    <input name="nazwisko" type="text" required class="form-control" id="surname" value="{{$user->vets->nazwisko}}">
                </div>
            </div>


            <div class="form-group">
                <label for="numer" class="col-lg-2 control-label">Numer telefonu</label>
                <div class="col-lg-10">
                    <input name="numer" type="text" required class="form-control" id="numer" value="{{$user->vets->phone->numer ?? null}}">
                </div>
            </div>

            <div class="form-group">
                <label for="opis" class="col-lg-2 control-label">Opis</label>
                <div class="col-lg-10">
                    <input name="opis" type="textarea" required class="form-control" id="surname" value="{{$user->vets->opis}}">
                </div>
            </div>

            <div class="form-group">
                <label for="cena" class="col-lg-2 control-label">Cena konsultacji</label>
                <div class="col-lg-10">
                    <input name="cena" type="text" required class="form-control" id="surname" value="{{$user->vets->cena_konsultacji}}">
                </div>
            </div>

            <div class="form-group">
                <label for="adres" class="col-lg-2 control-label">Adres</label>
                <div class="col-lg-10">
                    <input name="adres" type="text" required class="form-control" id="surname" value="{{$user->vets->adres}}">
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <label for="vetPicture">Add your photo</label>
                    <input name="vetPicture" type="file" id="vetPicture">
                </div>
            </div>
    
          
    
        </fieldset>
        
    </form>
</div>

@endsection