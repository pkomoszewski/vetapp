@extends('main')
@section('content')
<section>

    <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

    <section class="pricing py-5 ">
        <div class="container">
            <div class="row d-block">
                @csrf


                @if ($reservations->isEmpty())
                <div>Nie mam zaplanowanych wizyt</div>
                @else
                @foreach($reservations as $reservation)

                <div class="col-lg-4">


                    <div class="card mb-4">


                        <div class="card-body text-center">
                            <h5 class="card-title text-muted text-uppercase text-center"></h5>

                            <h6 class="card-text text-center">{{$reservation->day}} </h6>
                            <h6 class="card-text text-center">{{$reservation->hour}} </h6>
                            <h6 class="card-text text-center">Weterynarz: {{$reservation->vet->name}} </h6>


                            @if ($reservation->animal==null)
                            <td>Brak wybranego zwierzaka </td>
                            @else
                            <h6 class="card-text text-center">umówiony z {{$reservation->animal->imie}}
                                @endif


                                <p class="card-text text-center">{{$reservation->opis}} </p>
                            </h6>

                            <hr>

                            @if ($reservation->animal==null)
                            <td>Brak możliwości podejrzenia histori leczenia </td>
                            @else
                            <a href="{{ route('showHistoryTreatmeantAnimal',['id'=>$reservation->animal->id]) }}">
                                <button class="btn btn-dark btn-xs">Historia Leczenia
                                </button>
                            </a>
                            @endif



                        </div>
                        @auth
                        <div class="card-footer">
                            @if($reservation->status)
                            <p>Status: Potwierdzone</p>
                            @else
                            <p>Status: niepotwierdzone</p>
                            @endif


                        </div>
                        @endauth
                    </div>
                </div>
                @endforeach
                @endif

                {{$reservations->links()}}
            </div>
        </div>
    </section>

    @endsection