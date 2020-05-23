@extends('main')
@section('content')

<section class="jumbotron text-center">
  <div class="conatainer">
    <h1>Wizyta</h1>

    <p class="lead text-muted">Wizyta została zajestrowana</p>
    <p><a href="{{ route('calendarVisitToUser',['owner_id'=>Auth::user()->owners->id ]) }}">Twoje wizyty </a> </p>
    <p>Proszę poczekać na zakceptowanie wizyty</p>
  </div>

  </div>

</section>

@endsection