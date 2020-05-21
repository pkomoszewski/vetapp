@extends('main')

@section('content')
 


<section>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 order-lg-2">
        <div class="p-5">

          @if ($article->photos->isEmpty())
          @else
          <img class="img-fluid rounded-circle" src="{{$article->photos->first()->path}}" alt="">
          @endif

        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="p-5">
          <h2 class="display-4">{{$article->title}}</h2>
          <p>{{$article->content}}</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection