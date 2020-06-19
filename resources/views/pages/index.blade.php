@extends('main')

@section('content')
  <section class="site-blocks-cover overflow-hidden bg-light">
  <div class="container">
    <div class="row">
      <div  class="col-md-7 align-self-center text-center text-md-left">
        <div class="intro-text">
          <h2>Twój zwierzak <span class="d-md-block">szuka pomocy?</span></h2>
          <p class="mb-4">Znajdź weterynarza lub klinikę i umów się z na wizytę<span class="d-block"></p>
        </div>
        
        <form method="GET" action="{{ route('Search') }}" class="form-inline">
      <div id="searchHome" class="form-group">
          <input name="city" class="form-control autocomplete" type="text" placeholder="miasto">

          <select class="form-control ml-2" name="choose">
            <option>Weterynarz</option>
            <option>Klinika</option>

          </select>
        </div>
          <button id="btnSearch" type="submit" class="btn button-vet ml-3">Szukaj</button>
          
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

      <div class="col-lg-6 ">
        <div class="p-2">
          <h5>Najnowe komentarze o weterynarzach</h5>

          <div class="row">

            <div class="col mt-5">


              @foreach($comments as $comment)
              <div class="media">
                <div class="media-left padding-right-2">
                    <div class="avatar" >
                  
                        @if($comment->commentable->photos==null)
                        <img src="{{asset('/images/person.png')}}" class="avatar avatar-sm"/>
                      
                        @else
                        <img src="{{$comment->commentable->photos->first()->path}}" class="avatar avatar-sm"
                     />
                        @endif
                    </div>
                </div>
                <div class="media-body ml-2">
                
                  <div> <a href="{{$comment->commentable->link}}"><strong> {{$comment->commentable->Name}}</strong></a></div>
                  {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
                  $comment->rating) !!}
                  {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
                  $comment->rating) !!}
                  <div class="p-2 rounded" style="background-color: #eff2f8; min-height:50px" > {{$comment->content}}</div>
                  <em> {{$comment->user->owners->imie}}</em>
                </div>
            </div>
              <hr>
              @endforeach

            </div>



          </div>


        </div>

      </div>
      <div class="col-lg-6">

        <div class="p-2">
          <h5 >Najnowsze komentarze o artykułach</h5>

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
  <script>
    $(document).ready(function() {
    $("#btnSearch").click(function() {
      
      

      $(this).html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Wyszukaj...`
      );
    
    });
});
  </script>
</section>




@endsection