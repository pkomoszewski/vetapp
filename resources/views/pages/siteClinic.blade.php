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

                            <img src="{{url('/images/clinic.png')}}" class="avatar avatar-l">
                            @else
                            <img src="{{$clinic->photos->first()->path}}" class="avatar avatar-l"
                              >
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

                            <li class="nav-item">
                                <a class="nav-link" data-deleteid={{$clinic->id}} data-toggle="modal" data-target="#photo"
                                    href="">Photo</a>
                             
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
                                    href="#collapse" aria-expanded="false" aria-controls="collapse">
                                    Dodaj komentarz
                                </a>
                                @else
                                <p><a href="{{ route('login') }}">Zaloguj się, aby dodać komentarz</a></p>
                                @endauth

                                <div class="collapse" id="collapse">
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

                                <h6>Cennik</h6>
                                @if (!$clinic->service==null)
                                @foreach ($clinic->service->services as $service)
                                @isset($service['kind'])
                                <p>- {{$service['kind']}}: od {{$service['price']}} zł </p>
                                @endisset
                                @endforeach
                                @else
                                   <p>Brak informacji. </p> 
                                @endif
                                <hr>

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
    
    <div class="modal modal-danger fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @if (!$clinic->photos->isEmpty())
                
                <div id="carouselControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" >
                        @foreach ($clinic->photos as $photo)
                        <div class="carousel-item" id="carousel-item">
                            <img class="d-block w-100" src="{{$photo->path}}" alt="First slide">
                          </div> 
                        @endforeach
                     
                     
                    </div>
                    <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>   
                @else
                <div class="m-5">  <p>Brak zdjęć</p></div>
                  
                @endif
                
            </div>
        </div>
    </div>
    <script>
        $("#carousel-item").first().addClass( "active" );
        const latitude = {{$clinic->location->address_latitude ?? ''}}  || -33.8688;
           const longitude =  {{$clinic->location->address_longitude ?? ''}} ||  151.2195 ;
   
       var map;
                function initMap() {
                   var uluru = {lat: latitude, lng: longitude};
                   var map = new google.maps.Map(document.getElementById('address-map'), {
                   center: uluru,
                   zoom: 15,
                   disableDefaultUI: true,
                   scaleControl: true,
                   zoomControl: true,
                   styles:[ { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#6195a0" } ] }, { "featureType": "administrative.province", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [ { "lightness": "0" }, { "saturation": "0" }, { "color": "#f5f5f2" }, { "gamma": "1" } ] }, { "featureType": "landscape.man_made", "elementType": "all", "stylers": [ { "lightness": "-3" }, { "gamma": "1.00" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#bae5ce" }, { "visibility": "on" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 }, { "visibility": "simplified" } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "color": "#fac9a9" }, { "visibility": "simplified" } ] }, { "featureType": "road.highway", "elementType": "labels.text", "stylers": [ { "color": "#4e4e4e" } ] }, { "featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [ { "color": "#787878" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "transit.station.airport", "elementType": "labels.icon", "stylers": [ { "hue": "#0a00ff" }, { "saturation": "-77" }, { "gamma": "0.57" }, { "lightness": "0" } ] }, { "featureType": "transit.station.rail", "elementType": "labels.text.fill", "stylers": [ { "color": "#43321e" } ] }, { "featureType": "transit.station.rail", "elementType": "labels.icon", "stylers": [ { "hue": "#ff6c00" }, { "lightness": "4" }, { "gamma": "0.75" }, { "saturation": "-68" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#eaf6f8" }, { "visibility": "on" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#c7eced" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "lightness": "-49" }, { "saturation": "-53" }, { "gamma": "0.79" } ] } ]
               
                
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