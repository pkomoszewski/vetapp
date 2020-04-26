@extends('main')

@section('content')
 
@foreach ($data as $article)
    
  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle"  src="/storage/images/{{$article->image}}"alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">{{$article->tytul}}</h2>
            <p>{{$article->tresc}}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endforeach
@endsection