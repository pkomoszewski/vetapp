@extends('main')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">

                <div class="card-title mb-4">
                    <div class="d-flex justify-content-start">
                        <div class="image-container">
                            @if ($vet->photos->isEmpty())

                            <img src="{{url('/images/person.png')}}" class="img-circle img-responsive" with='150px'
                                height='150px'>
                            @else
                            <img src="{{$vet->photos->first()->path}}" alt="" class="img-circle img-responsive"
                                with='150px' height='150px'>
                            @endif

                        </div>
                        <div class="userData ml-3">
                            <h3>{{ $vet->imie }} {{ $vet->nazwisko}}</h3>


                            <p>Adres: {{ucwords($vet->locations->first()->address) }} {{ucwords($vet->locations->first()->miejscowosc)}}</p>
                            <p> Cena kosultacji: {{$vet->cena_konsulatcji}} zł<p>

                                    {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
                                    $vet->averageRating()) !!}
                                    {{-- Mozna spróbowac przypisac zmiena do cache.  Dwa razy sie wykonuje zapytanie do bazy nie potrzebnie--}}
                                    {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
                                    $vet->averageRating()) !!}
                                    <p> Opini {{$vet->comments->count()}}</p>
                                    <p>{{ $vet->users->count() }} osób lubli</p>

                                    @auth
                                    @if($vet->isLiked())
                                    <p>Lubisz tego weterynarza</p>
                                    <a href="{{ route('unlike',['like_id'=>$vet->id,'type'=>'App\Vet']) }}">Anuluj
                                        polubienie</i></a>
                                    @else

                                    <a href="{{ route('like',['like_id'=>$vet->id,'type'=>'App\Vet']) }}"><i
                                            class="fas fa-thumbs-up"></i></a>
                                    @endif
                                    @endauth
                                    <div class="row">

                                        @if(Auth::guest())
                                        <p><a href="{{ route('login') }}">Zaloguj sie aby umówić się na
                                                wizyte</a>
                                        </p>
                                        @else
                                        <a href="{{ route('reservationscalendar',['vet_id'=>$vet->id,'user_id'=>Auth::user()->id]) }}"
                                            class="btn button-vet pull-right m-3" role="button">Umów się na
                                            wizytę</a>
                                        @endif
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab"> O
                                    mnie</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="map-tab" data-toggle="tab" href="#experience"
                                    role="tab">Usługi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment"
                                    role="tab">Komenatrze
                                    użytkowników</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab">Adresy</a>
                            </li>
                        </ul>
                        <div class="tab-content ml-1" id="myTabContent">

                            <div class="tab-pane fade" id="comment" role="tabpanel">
                                @foreach( $vet->comments as $comment )

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
                                            action="{{ route('addComment',['commentable_id'=>$vet->id, 'type'=>'App\Vet'])}}"
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

                            <div class="tab-pane fade" id="map" role="tabpanel">
                                <div class="col-md-4 col-6">


                                </div>
                                @php
                                $i=1
                                @endphp
                                @foreach ($vet->locations as $location )

                                <h6>Adres {{$i}}</h6>



                                <p>Adres: {{$location->address}} {{$location->city->name}}</p>
                              
                                <div id="div{{$i}}" class=" data">
                                    <div class=" mb-2">

                                        <a data-deleteid={{$vet->id}} data-toggle="modal" data-target="#showmap"
                                            href="">Pokaż na
                                            mapie</a>
                                    </div>
                              
                                    <div>
                                        <h6>Godziny przyjęć</h6>
                                        @foreach ($location->whenOpen as $time)
                                        @isset($time['key'])
                                        <b>{{$time['key']}}</b>: {{ $time['value']}}<br />

                                        @endisset
                                        @endforeach

                                    </div>

                                    @php
                                    $i++
                                    @endphp
                                </div>
                                <hr>
                                @endforeach

                            </div>

                            <div class="tab-pane fade show active" id="about" role="tabpanel">


                                <h6>Opis</h6>
                                <p> {{ $vet->opis}}</p>
                                <div class="d-flex">
                                    <div>
                                        <h6>Specjalizacje</h6>
                                        @foreach ($vet->specializations as $specialization)
                                        <p>- {{$specialization ->name}}</p>
                                        @endforeach
                                    </div>

                                </div>



                            </div>
                            <div class="tab-pane fade" id="experience" role="tabpanel">
<h6>Cennik</h6>
@if (!$vet->service==null)
@foreach ($vet->service->services as $service)
@isset($service['kind'])
<p>- {{$service['kind']}}: od {{$service['price']}} zł </p>
@endisset
@endforeach
@else
   <p>Brak informacji. </p> 
@endif
<hr>
<h6>Możliwość wizyty domowej</h6>
@if ($vet->homevisit)
    <p>Tak</p>
  @else
  <p>Nie</p>
@endif

                            </div>


                        </div>

                    </div>
                </div>
            </div>


        </div>



    </div>

</div>

<div class="modal modal-danger fade" id="showmap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="width: 100%; height: 400px" id="address-map"></div>
        </div>
    </div>
</div>

<script>
     const latitude = {{$vet->locations->first()->address_latitude}}  || -33.8688;
        const longitude =  {{$vet->locations->first()->address_longitude}} ||  151.2195 ;

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