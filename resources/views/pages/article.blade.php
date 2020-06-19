@extends('main')

@section('content')
 


<section>
  <div class="container ">
    <div class="row align-items-center flex-column-reverse ">
      <div class="col-lg-12 order-lg-2">
        <div class="p-5">

          @if ($article->photos->isEmpty())
          @else
          <img class="rounded float-left max-width: 20%; and height: auto;" width="50%"
            src="{{$article->photos->first()->path}}" >
          @endif

        </div>
      </div>
      <div class="col-lg-12 order-lg-1">
        <div class="p-5">
          <h2 class="display-4">{{$article->title}}</h2>
          <p>{{$article->content}}</p>
        </div>

      </div>

    </div>


    @isset($article->comments)
    <div class="row ">

      <div class="col-12 mt-5">


        @foreach( $article->comments as $comment)


        <p> {{$comment->user->email}} </p>

        {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
        $comment->rating) !!}
        {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
        $comment->rating) !!}
        <p>{{$comment->content}}</p>



        <hr>
        @endforeach

        @endisset

        @empty($article->comments)
        <p>Brak komentarzy</p>
        @endempty



        @auth
        <a class="btn button-vet" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
          aria-controls="collapseExample">
          Dodaj komentarz
        </a>
        @else
        <p><a href="{{ route('login') }}">Zaloguj się, aby dodać komentarz</a></p>
        @endauth









        <div class="collapse" id="collapseExample">
          <div class="well">

            <form method="POST"
              action="{{ route('addComment',['commentable_id'=>$article->id, 'type'=>'App\Article'])}}"
              class="form-horizontal">
              <fieldset>
                <div class="form-group">
                  <label for="textArea" class="col-lg-2 control-label">Komentarz</label>
                  <div class="col-lg-10">
                    <textarea required name="content" class="form-control" rows="3" id="textArea"></textarea>
                    <span class="help-block">Pole jest wymagane</span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="select" class="col-lg-2 control-label">Gwiazdki</label>
                  <div class="col-lg-10">
                    <select name="rating" class="form-control" id="select">
                      <option value="5">5</option>
                      <option value="4">4</option>
                      <option value="3">3</option>
                      <option value="2">2</option>
                      <option value="1">1</option>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn button-vet">Zapisz komentarz</button>
                  </div>
                </div>
              </fieldset>
              {{ csrf_field() }}
            </form>
          </div>
        </div>


      </div>



    </div>

  </div>


</section>

@endsection