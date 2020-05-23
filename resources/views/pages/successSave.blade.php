@extends('main')
@section('content')

<section class="jumbotron text-center">
  <div class="conatainer">
    <h1>Profile został zapisany</h1>


    <p><a href="{{ route('profile.index',['user'=>Auth::user()->id ])}}">Wróć do profilu </a> </p>

  </div>

  </div>

</section>

@endsection