@extends('main')

@section('content')
  <section class="site-blocks-cover overflow-hidden bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-7 align-self-center text-center text-md-left">
        <div class="intro-text">
          <h1>Twoj zwierzak <span class="d-md-block">szuka pomocy?</span></h1>
          <p class="mb-4">Znajdź weterynarza lub klinikę i umów się z na wizytę<span class="d-block"></p>
        </div>
        <form method="GET" action="{{ route('Search') }}" class="form-inline">

          <input name="city" class="form-control autocomplete" type="text" placeholder="miasto">

          <select class="form-control ml-2" name="choose">
            <option>Weterynarz</option>
            <option>Klinika</option>

          </select>
          <button type="submit" class="btn button-vet ml-3">Szukaj</button>

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

      <div class="col-lg-6 order-lg-1">
        <div class="p-5">
          <h4 class="display-10">Najnowe komentarze o weterynarzach</h4>

          <div class="row">

            <div class="col-lg-6 mt-5">


              @foreach($comments as $comment)

              @isset($comment->commentable->Type)
              <h6>{{$comment->commentable->Type}} </h6>
              @endisset



              {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
              $comment->rating) !!}
              {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
              $comment->rating) !!}
              <p>{{$comment->content}}</p>
              <p class="display-10"> {{$comment->user->owners->imie}}</p>
              <hr>
              @endforeach

            </div>



          </div>


        </div>

      </div>
      <div class="col-lg-6">

        <div class="p-5">
          <h4 class="display-10">Najnowsze komentarze o artykułach</h4>

          <div class="row">

            <div class="col-lg-6 mt-5">


              @foreach($articlecomments as $comment)


              <h6> {{$comment->commentable->Type}}</h6>


              {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
              $comment->rating) !!}
              {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
              $comment->rating) !!}
              <p>{{$comment->content}}</p>
              <p class="display-10"> {{$comment->user->owners->imie}}</p>
              <hr>
              @endforeach

            </div>



          </div>


        </div>
      </div>
    </div>

  </div>



  </div>
</section>




@endsection