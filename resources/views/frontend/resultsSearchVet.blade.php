@extends('main')

@section('content')
<div class="container">
<div class="row">

    <p>Sortuj według</p>

      <select class="form-control ml-2" name="sortby">

            <option>Opinii</option>

            <option>ilość komentarzy</option>

          </select>

    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">



                    @if(!$results==null)

                    @foreach ($results as $vet)
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">
                                    <div class="image-container">
                                        @if ($vet->photos->isEmpty())
                                        @else
                                        <img src="{{$vet->photos->first()->path}}" alt=""
                                            class="img-circle img-responsive" with='100px' height='100px'>
                                        @endif

                                    </div>
                                    <div class="userData ml-3">
                                        <a href="{{ route('sitevet',['id'=>$vet->id]) }}">
                                            <p> {{$vet->imie}} {{$vet->nazwisko}}</p>
                                        </a>
                                        <p>{{$vet->adres}}</p>
                                        {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
                                        $vet->averageRating()) !!}
                                        {{-- Mozna spróbowac przypisac zmiena do cache.  Dwa razy sie wykonuje zapytanie do bazy nie potrzebnie--}}
                                        {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
                                        $vet->averageRating()) !!}
                                        <p> Opini {{$vet->comments->count()}}</p>
                                        <p>{{ $vet->users->count() }} osób lubli</p>

                                        <div class="row">

                                            @if(Auth::guest())
                                            <p><a href="{{ route('login') }}">Zaloguj sie aby umówić się na wizyte</a>
                                            </p>
                                            @else
                                            <a href="{{ route('reservationscalendar',['vet_id'=>$vet->id,'user_id'=>Auth::user()->id]) }}"
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
