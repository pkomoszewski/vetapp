@extends('main')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">




            <div class="card-body">

                <div class="card-title mb-4">
                    <div class="d-flex justify-content-start">
                        <div class="image-container">
                            @if ($clinic->photos->isEmpty())

                            <img src="{{url('/images/clinic.png')}}" class="img-circle img-responsive" with='150px'
                                height='150px'>
                            @else
                            <img src="{{$clinic->photos->first()->path}}" alt="" class="img-circle img-responsive"
                                with='150px' height='150px'>
                            @endif

                        </div>
                        <div class="userData ml-3">



                            <h3>{{ $clinic->nazwa}}</h3>


                            <p>Adres: {{ucwords($clinic->location->address) }}</p>


                            {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
                            $clinic->averageRating()) !!}
                            {{-- Mozna spróbowac przypisac zmiena do cache.  Dwa razy sie wykonuje zapytanie do bazy nie potrzebnie--}}
                            {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
                            $clinic->averageRating()) !!}
                            <p> Opini {{$clinic->comments->count()}}</p>
                            <p>{{ $clinic->users->count() }} osób lubli</p>

                            @auth
                            @if($clinic->isLiked())
                            <p>Lublisz tę klinicę</p>
                            <a href="{{ route('unlike',['like_id'=>$clinic->id,'type'=>'App\Clinic']) }}">Anuluj
                                polubienie</i></a>
                            @else

                            <a href="{{ route('like',['like_id'=>$clinic->id,'type'=>'App\Clinic']) }}"><i
                                    class="fas fa-thumbs-up"></i></a>
                            @endif
                            @endauth



                        </div>


                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" id="opis-tab" data-toggle="tab" href="#opis" role="tab">Opis</a>
                            </li>



                            <li class="nav-item">
                                <a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab">Adres</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="services-tab" data-toggle="tab" href="#services"
                                    role="tab">Usługi</a>
                            </li>




                            <li class="nav-item ">
                                <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment"
                                    role="tab">Komenatrze
                                    użytkowników</a>
                            </li>
                        </ul>
                        <div class="tab-content ml-1" id="myTabContent">

                            <div class="tab-pane fade " id="comment" role="tabpanel">
                                @foreach( $clinic->comments as $comment )

                                <li class="list-group-item  mb-2">
                                    <p>{{$comment->user->email}}</p>
                                    {!! str_repeat('<i class="fa fa-star"></i>',
                                    $comment->rating) !!}
                                    {!! str_repeat('<i class="fa fa-star-o"></i>', 5 -
                                    $comment->rating) !!}
                                    <p>{{$comment->content}}</p>


                                    <hr />

                                </li>
                                @endforeach

                                @auth
                                <a class="btn button-vet mt-2" role="button" data-toggle="collapse"
                                    href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Dodaj komentarz
                                </a>
                                @else
                                <p><a href="{{ route('login') }}">Zaloguj się, aby dodać komentarz</a></p>
                                @endauth

                                <div class="collapse" id="collapseExample">
                                    <div class="well">

                                        <form method="POST"
                                            action="{{ route('addComment',['commentable_id'=>$clinic->id, 'type'=>'App\Vet'])}}"
                                            class="form-horizontal">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="textArea"
                                                        class="col-lg-2 control-label">Komentarz</label>
                                                    <div class="col-lg-10">
                                                        <textarea required name="content" class="form-control" rows="3"
                                                            id="textArea"></textarea>
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
                                                        <button type="submit" class="btn button-vet">Zapisz
                                                            komentarz</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            {{ csrf_field() }}
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade " id="map" role="tabpanel">

                                <div>
                                    <h6>Adres</h6>
                                    <p>Adres: {{$clinic->location->address}}</p>
                                    <a data-deleteid={{$clinic->id}} data-toggle="modal" data-target="#delete"
                                        href="">Pokaż na
                                        mapie</a>


                                </div>

                                <div class="mt-2">
                                    <h6>Godziny otwarcia</h6>
                                    @foreach ($clinic->location->whenOpen as $time)
                                    @isset($time['key'])
                                    <b>{{$time['key']}}</b>: {{ $time['value']}}<br />

                                    @endisset

                                    @endforeach
                                </div>
                            </div>




                            <div class="tab-pane fade show active" id="opis" role="tabpanel">

                                <h6>Opis</h6>
                                <p>{{$clinic->opis}}</p>

                            </div>

                            <div class="tab-pane fade" id="services" role="tabpanel">

                                <h6>Usługi</h6>
                                <p>siemka</p>

                            </div>
                        </div>
                    </div>
                </div>


            </div>



        </div>

    </div>

    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="width: 100%; height: 400px" id="address-map"></div>
            </div>
        </div>
    </div>
    <script>
        var map;
             function initMap() {
                var uluru = {lat: {{$clinic->address_latitude}}, lng: {{$clinic->address_longitude}}};
                var map = new google.maps.Map(document.getElementById('address-map'), {
                center: uluru,
                zoom: 15,
             
               });
             
                var marker = new google.maps.Marker({position: uluru, map: map});
                 }
             
    </script>
</div>

@endsection

@section('javascript')

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY')}}&callback=initMap">
    async defer
</script>

@endsection