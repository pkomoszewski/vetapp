
@extends('main') 

@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
<div class="container m-5">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://lorempixel.com/200/200/people/?x=<?= mt_rand(1, 9999999) ?>" alt="" class="img-circle img-responsive">
                        </div>
                        <div class="col-xs-12 col-sm-9 ">
                       
                            <p>  {{$user->email}}</p>
                            <p>  {{$user->Owners->Imie}}</p>
                            <p>  {{$user->Owners->Nazwisko}}</p>

                            <a href="{{ route('profile',['user'=>Auth::user()->id]) }}"> Edycja profilu </a>

                        </div>
                    </div>

                        <div class="col-sm-12 top-buffer">
                            <div class='bg-info text-white text-center d-flex justify-content-between'><span class="fa fa-plus-circle"></span>Moje Zwierzęta Ilość: {{$user->animals->count()}}
                                <p><a href="{{ route('addAnimal') }}" class="btn btn-primary btn-xs" role="button">Dodaj</a></p>
                       
                            </div>
                            @if ($user->animals->isEmpty())
                            <div>Nie mam aktualnie dodanych zwierząt</div>
                        @else
                        @foreach($user->animals as $animal)

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="">{{$animal->Imie}}</a>

                                    <p>Gatunek: {{$animal->gatunek}}</p>
                                    <a href='/{{$animal->id}}/delete'>Usuń</a>
                                </li>
                               
                             

                            @endforeach
                            @endif
                                
                        </div>
                        <div class="col-sm-12">
                            @if ($user->comments->isEmpty())
                            <div>Nie mam aktualnie żadnych komentarzy</div>
                        @else
                      <p>  Moje komentarze </p>
                            @foreach($user->comments as $comment)
                            <li class="list-group-item"> 
                               {{$comment->content}}

                                <hr/>
                                <a href="{{ $comment->commentable->link}}">{{ $comment->commentable->type }}</a>
                            </li>
                               
                            @endforeach
                            @endif

                        </div>
                    

                        Jeszcze dopisac polubienia
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection