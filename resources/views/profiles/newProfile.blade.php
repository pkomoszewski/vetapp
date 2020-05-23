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
                                @if ($vet->photos->isEmpty())
                                @else
                                <img src="{{$vet->photos->first()->path}}" alt="" class="img-circle img-responsive"
                                    with='100px' height='100px'>
                                @endif
                            </div>
                            <div class="col-xs-12 col-sm-9 ">

                                <p>{{$vet->imie}}</p>
                                <p>{{$vet->nazwisko}}</p>
                                @if ($vet->phone==null)
                                <p>Brak telefonu. Proszę o wypełnienie</p>
                                @else
                                <p>{{$vet->phone->numer}}<p>
                                        @endif
                                        @if ($vet->opis=='')
                                        <p>Brak opisu. Proszę o wypełnienie</p>
                                        @else
                                        <p>{{$vet->opis}}<p>
                                                @endif
                                                <p>{{$vet->adres}}</p>
                                                <p>Do porawy pokazywanie miasta</p>
                                                <p> Cena kosultacji: {{$vet->cena_konsulatcji}} zł</p>
                                                <p>Godziny przyjmowania od
                                                    {{$vet->TimeStart}}
                                                    do
                                                    {{$vet->TimeEnd}}</p>

                                                <a href="{{ route('profile',['user'=>Auth::user()->id]) }}">
                                                    Edycja
                                                    profilu Weterynarza </a>

                            </div>
                        </div>




                    </div>
                    <div class="col-sm-12">
                        <div class="col-6">
                            @foreach( $vet->comments as $comment )
                            <div class="media">
                                {{$comment->user->email}}

                                <div class="media-body">
                                    {{ $comment->content  }}
                                </div>
                            </div>
                            <hr>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection