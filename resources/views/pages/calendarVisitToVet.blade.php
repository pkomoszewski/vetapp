@extends('main')
@section('content')
<section>

    <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

    <section class="pricing py-5 ">
        <div class="container">
            <div class="row d-block">
                @csrf

                wizyty u weterynarza
                @if ($reservations->isEmpty())
                <div>Nie mam zaplanowanych wizyt</div>
                @else
                @foreach($reservations as $reservation)

                <div class="col-lg-4">


                    <div class="card mb-4">


                        <div class="card-body">
                            <h5 class="card-title text-muted text-uppercase text-center"></h5>

                            <h6 class="card-text text-center">{{$reservation->day}} </h6>
                            <h6 class="card-text text-center">{{dd($reservation->owners)}} </h6>
                            <h6 class="card-text text-center">{{$reservation->hour}} </h6>
                            <h6 class="card-text text-center"> {{$reservation->status}}</h6>

                            <hr>



                        </div>
                        <div class="card-footer">
                            Potwierdzam
                        </div>
                    </div>
                </div>
                @endforeach
                @endif


            </div>
        </div>
    </section>

    @endsection