@extends('main')

@section('content')
  <section class="site-blocks-cover overflow-hidden bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-7 align-self-center text-center text-md-left">
        <div class="intro-text">
          <h1>Twoj zwierzak <span class="d-md-block">szuka pomocy?</span></h1>
          <p class="mb-4">Znajdz weterynarza i umów się z na wizytę<span class="d-block"></p>
        </div>
        <form method="POST" action="{{ route('vetSearch') }}" class="form-inline">

          <input name="city" class="form-control autocomplete" type="text" placeholder="wyszukaj"
            aria-label="wyszkukaj">
          <button type="submit" class="btn btn-dark ml-3">Szukaj</button>
          @csrf
        </form>
      </div>
      <div class="col-md-5 align-self-end text-center text-md-right">
        <img src="images/dogger_img_1.png" alt="Image" class="img-fluid cover-img">
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 order-lg-2">
        <div class="p-5">
          <img class="img-fluid rounded-circle" src="img/01.jpg" alt="">
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="p-5">
          <h4 class="display-10">Najnowe komontarze o weterynarzach</h4>





          <div class="row">

            <div class="col-6 mt-5">


              @foreach($comments as $comment)

              <h5 class="display-10"> {{$comment->user->owners->imie}}</h5>


              <p> {{$comment->content}}</p>


              {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
              $comment->rating) !!}
              {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
              $comment->rating) !!}
              <p>{{$comment->content}}</p>



              <hr>
              @endforeach

            </div>

          </div>


        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="p-5">
          <img class="img-fluid rounded-circle" src="img/02.jpg" alt="">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="p-5">
          <h4 class="display-10">Najnowe komontarze o artykułach</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse
            assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae
            adipisci, beatae obcaecati.</p>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection