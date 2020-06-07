@extends('main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end m-3 ">
        <div ">
            <p>Sortuj według:</p>

            <select class=" form-control ml-2" name="sortby">

            <option>Opinii</option>
            <option>ilość polubień</option>

            </select>

        </div>


    </div>

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
                                        <img src="{{url('/images/clinic.png')}}" class="img-responsive" with='150px'
                                            height='150px'>

                                        @else
                                        <img src="{{$clinic->photos->first()->path}}" alt=""
                                            class="img-circle img-responsive" with='100px' height='100px'>
                                        @endif

                                    </div>
                                    <div class="userData ml-3">
                                        <a href="{{ route('siteclinic',['id'=>$clinic->id]) }}">
                                            <p> {{$clinic->nazwa}}</p>

                                        </a>
                                        <p> {{$clinic->opis}}</p>
                                        <p>{{$clinic->adres}}</p>
                                        {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
                                        $clinic->averageRating()) !!}
                                        {{-- Mozna spróbowac przypisac zmiena do cache.  Dwa razy sie wykonuje zapytanie do bazy nie potrzebnie--}}
                                        {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
                                        $clinic->averageRating()) !!}
                                        <p> Opini {{$clinic->comments->count()}}</p>
                                        <p>{{ $clinic->users->count() }} osób lubli</p>


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