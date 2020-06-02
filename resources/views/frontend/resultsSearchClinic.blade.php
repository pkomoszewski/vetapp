@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">


                    @if(!$results==null)
                    @foreach ($results as $clinic)
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">
                                    <div class="image-container">
                                        @if ($clinic->photos->isEmpty())
                                        @else
                                        <img src="{{$clinic->photos->first()->path}}" alt=""
                                            class="img-circle img-responsive" with='100px' height='100px'>
                                        @endif

                                    </div>
                                    <div class="userData ml-3">
                                        <a href="{{ route('siteclinic',['id'=>$clinic->id]) }}">
                                            <p> {{$clinic->nazwa}}</p>
                                            <p> {{$clinic->opis}}</p>
                                        </a>
                                        <p>{{$clinic->adres}}</p>
                                        {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
                                        $clinic->averageRating()) !!}
                                        {{-- Mozna spróbowac przypisac zmiena do cache.  Dwa razy sie wykonuje zapytanie do bazy nie potrzebnie--}}
                                        {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
                                        $clinic->averageRating()) !!}
                                        <p> Opini {{$clinic->comments->count()}}</p>
                                        <p>{{ $clinic->users->count() }} osób lubli</p>

                                        <div class="row">

                                            @if(Auth::guest())
                                            <p><a href="{{ route('login') }}">Zaloguj sie aby umówić się na wizyte</a>
                                            </p>
                                            @else
                                            <a href="{{ route('reservationscalendar',['clinic_id'=>$clinic->id,'user_id'=>Auth::user()->id]) }}"
                                                class="btn btn-dark pull-right m-3" role="button">Umów się na wizytę</a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    @else
                    <h6>Brak wyników wyszukiwania</h6>
                    @endif


                    @endsection