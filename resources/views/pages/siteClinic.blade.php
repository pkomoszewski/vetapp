@extends('main')
@section('javascript')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="container m-5">
                            <div class="col-xs-12 col-sm-3">
                                @if ($clinic->photos->isEmpty())
                                @else
                                <img src="{{$clinic->photos->first()->path}}" alt="" class="img-circle img-responsive"
                                    with='100px' height='100px'>
                                @endif
                            </div>
                            <div class="col-xs-12 col-sm-9 ">
                                <p>{{ $clinic->nazwa }}</p>
                                <p>{{ $clinic->opis}}</p>
                                <p>{{ $clinic->adres }}</p>
                                <p>{{ $clinic->phone->numer ?? 'brak numeru'}}</p>
                                <p>godzina otwarcia: {{ $clinic->godzina_otwarcia }}</p>
                                <p>godzina zamkniecia:{{ $clinic->godzina_zamkniecia }}</p>

                                powinno jeszcze byc do pobrania dni otwarte dni zamkniete


                                @auth
                                <div class="col-6 ml-2">
                                    @if($clinic->isLiked())
                                    <a href="{{ route('unlike',['like_id'=>$clinic->id,'type'=>'App\Clinic']) }}"
                                        class="btn btn-primary btn-xs top-buffer">Usuń polubienie</a>
                                    @else
                                    <a href="{{ route('like',['like_id'=>$clinic->id,'type'=>'App\Clinic']) }}"
                                        class="btn btn-primary btn-xs top-buffer">Polub</a>
                                    @endif
                                    @endauth
                                </div>

                                <div class="row">

                                    <div class="col-6 mt-5">
                                        Komentarze

                                        @foreach( $clinic->comments as $comment)


                                        <p> {{$comment->user->owners->Imie}} </p>

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

                    <div class="row mt-5">
                        <div class="col-12">
                            <div style="width: 100%; height: 400px" id="address-map"></div>

                            <script>
                                var map;
       
          var default_zoom = 10;
          function initMap() {
            var center = new google.maps.LatLng(
              latitude,
              longitude);
            var mapOptions = {
                
              zoom: default_zoom,
              center: center
            };
            map = new google.maps.Map(document.getElementById('address-map'), mapOptions);
            var marker =
            var markerLatLng = new google.maps.LatLng(
              parseFloat(marker.latitude),
              parseFloat(marker.longitude));
            var icon = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
            mark = new google.maps.Marker({
              map: map,
              position: markerLatLng,
              icon: icon
            });
          }
                            </script>

                        </div>
                    </div>
                </div>

                @auth
                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample">
                    Add comment
                </a>
                @else
                <p><a href="{{ route('login') }}">Login to add a comment</a></p>
                @endauth


                <div class="collapse" id="collapseExample">
                    <div class="well">


                        <form method="POST"
                            action="{{ route('addComment',['commentable_id'=>$clinic->id, 'type'=>'App\Clinic'])}}"
                            class="form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-2 control-label">Komentarz</label>
                                    <div class="col-lg-10">
                                        <textarea required name="content" class="form-control" rows="3"
                                            id="textArea"></textarea>
                                        <span class="help-block">Pole jest wymagane</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="select" class="col-lg-2 control-label">Gwiazdki</label>
                                    <div class="col-lg-10">
                                        <select name="rating" class="form-control" id="rating">
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
                                        <button type="submit" class="btn btn-primary">Wyślij</button>
                                    </div>
                                </div>
                            </fieldset>
                            {{ csrf_field() }}
                        </form>

                    </div>
                </div>
                @endsection
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY')}}&callback=initMap">
                </script>
                @endsection