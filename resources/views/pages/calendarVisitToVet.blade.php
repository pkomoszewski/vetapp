@extends('main')
@section('content')
<section>

    <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

    <section class="pricing py-5 ">
        <div class="container">
            <div class="row d-block">
                <h3>Planowane wizyty pacjentów</h3>
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
                            <h6 class="card-text text-center">{{$reservation->vet->imie}} </h6>
                            <h6 class="card-text text-center">{{$reservation->animal->imie}} </h6>
                            <h6 class="card-text text-center">{{$reservation->hour}} </h6>
                            <p class="card-text text-center">{{$reservation->opis}} </p>

                            </h6>

                            <hr>


                            <a href="{{ route('showformAddHistoryTreatmeantAnimal',['id'=>$reservation->animal->id]) }}"
                                class="btn btn-dark btn-xs top-buffer">Dodaj historie leczenia</a>
                        </div>
                        @auth
                        <div class="card-footer text-center">

                            @if($reservation->status)
                            <p>Potwierdzone</p>
                            @else
                            <a href="{{ route('confirmReservationVet',['vet_id'=>$vet_id,'reservation_id'=>$reservation->id]) }}"
                                class="btn btn-dark btn-xs top-buffer">Potwierdz</a>
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