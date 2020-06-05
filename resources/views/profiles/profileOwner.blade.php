@extends('layouts.Backend.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                <img src="{{url('/images/person.png')}}" id="imgProfile"
                                    style="width: 150px; height: 150px" class="img-thumbnail" />
                                <div class="middle">
                                    <a class="btn button-vet mt-2"
                                        href="{{ route('profile',['user'=>Auth::user()->id]) }}"> Edycja profilu </a>



                                </div>
                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a
                                        href="javascript:void(0);">
                                        <p> {{$user->owners->Imie}}</p>
                                    </a></h2>
                                <h6 class="d-block">Liczba komentarzy: {{$user->comments->count()}}</h6>
                                <h6 class="d-block">Liczba zwierzęta: {{$user->owners->animals->count()}}</h6>
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-primary d-none" id="btnDiscard"
                                    value="Discard Changes" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo"
                                        role="tab">Informacje</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Animal-tab" data-toggle="tab" href="#Animal" role="tab">Moje
                                        zwierzęta</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment"
                                        role="tab">Moje komentarze</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings"
                                        role="tab">Ustawienia</a>
                                </li>

                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                    aria-labelledby="basicInfo-tab">


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Imię</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{$user->owners->imie}}
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Email</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <p> {{$user->email}}</p>
                                        </div>
                                    </div>
                                    <hr />




                                </div>
                                <div class="tab-pane fade" id="Animal" role="tabpanel" aria-labelledby="Animal-tab">
                                    @if ($user->owners->animals->isEmpty())
                                    <div>Nie mam aktualnie dodanych zwierząt</div>
                                    @else
                                    @foreach($user->owners->animals as $animal)


                                    <li class="list-group-item mb-2">
                                        <a href="">{{$animal->imie}}</a>

                                        <p>Gatunek: {{$animal->gatunek}}</p>
                                        <a href='/{{$animal->id}}/delete'>Usuń</a>
                                    </li>



                                    @endforeach
                                    @endif


                                    <a href="{{ route('addAnimal') }}" class="btn button-vet btn-xs"
                                        role="button">Dodaj</a>
                                </div>


                                <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                                    @if ($user->comments->isEmpty())
                                    <div>Nie mam aktualnie żadnych komentarzy</div>
                                    @else
                                    <p> Moje komentarze </p>
                                    @foreach($user->comments as $comment)
                                    <li class="list-group-item  mb-2">
                                        {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
                                        $comment->rating) !!}
                                        {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
                                        $comment->rating) !!}
                                        <p>{{$comment->content}}</p>


                                        <hr />
                                        <a href="{{ $comment->commentable->link}}">{{ $comment->commentable->type }}</a>
                                    </li>

                                    @endforeach
                                    @endif


                                </div>

                                <div class="tab-pane fade " id="settings" role="tabpanel"
                                    aria-labelledby="settings-tab">


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Usunięcie konta</label>
                                        </div>
                                        <div class="col-md-8 col-6">

                                            <button class="btn btn-danger" data-deleteid="{{Auth::id()}}"
                                                data-toggle="modal" data-target="#delete">Usuń</button>
                                        </div>
                                    </div>
                                    <hr />


                                    <hr />




                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="myModalLabel">Potwierdzienie usunięcia</h4>
                </div>
                <form action="{{route('deleteSelf')}}" method="post">

                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">
                            Czy napewno chcesz usunąć swoje konto?
                        </p>
                        <input type="hidden" name="delete_id" id="delete_id" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-warning">Tak, Usuń</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection