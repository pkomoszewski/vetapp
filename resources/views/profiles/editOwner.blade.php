@extends('layouts.Backend.main')

@section('content')

<div class="container">
    <h2>Dane użytkownika</h2>
    <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="{{ route('editProfile',['user'=>Auth::user()->id]) }}">
        @csrf
        <fieldset>
            <div class="form-group">
                <label for="imie" class="col-lg-2 control-label">Imię:</label>
                <div class="col-lg-10">
                    <input name="name" type="text" required class="form-control" id="imie" value="{{$user->owners->imie}}">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Email:</label>
                <div class="col-lg-10">
                    <input name="email" type="email" required class="form-control" id="inputEmail" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn button-vet">Zapisz</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <label for="userPicture">Dodaj swoje zdjecie</label>
                    <input name="userPicture" type="file" id="userPicture">
                </div>
            </div>
            @isset($user->owners->photo)
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail w-20" >
                    <img class="img-fluid" src="{{asset($user->owners->photo->path)  ?? $placeholder }}" alt="...">
                    <div class="mt-2">
                        <p><a href="{{ route('deletePhoto',['id'=>$user->owners->photo->id])}}" >Usuń</a></p>
                    </div>

                </div>
            </div>
            @endisset
        </fieldset>
    </form>
</div>

@endsection