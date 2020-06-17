@extends('layouts.Backend.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                @if($vet->photos->isEmpty())
                                <img src="{{url('/images/person.png')}}" id="imgProfile"
                                    style="width: 250px; height: 180px" class="img-thumbnail" />

                                @else
                                <img src="{{$vet->photos->first()->path}}" id="imgProfile"
                                    style="width: 250px; height: 180px" class="img-thumbnail" />
                                @endif
                                <div class="middle">
                                    <a class="btn button-vet mt-2"
                                        href="{{ route('editProfile',['user'=>Auth::user()->id]) }}"> Edycja
                                        profilu </a>
                                </div>
                            </div>
                            <div class="userData ml-3">

                                <h6 class="d-block"> liczba
                                    komentarzy: {{$vet->comments->count()}}</h6>

                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-primary d-none" id="btnDiscard"
                                    value="Discard Changes" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo"
                                        role="tab">Informacje</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab">Adres</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment"
                                        role="tab">Komentarze
                                        użytkowników</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" id="service-tab" data-toggle="tab" href="#service"
                                        role="tab">Usługi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="setting-tab" data-toggle="tab" href="#setting"
                                        role="tab">Ustawienia
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="klinka-tab" data-toggle="tab" href="#klinka" role="tab">Klinka
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel">


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Imie i Nazwisko:</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{$vet->name}}

                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Adres email:</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{$vet->user->email}}

                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Numer telefonu:</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            @if ($vet->phone==null)
                                            <p>Brak telefonu. Proszę o wypełnienie</p>
                                            @else
                                            <p>{{$vet->phone->numer}}<p>
                                                    @endif
                                        </div>
                                    </div>
                                    <hr />


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Opis:</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            @if ($vet->opis=='')
                                            <p>Brak opisu. Proszę o wypełnienie.</p>
                                            @else
                                            <p>{{$vet->opis}}<p>
                                                    @endif
                                        </div>
                                    </div>

                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Miasto</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{$vet->locations->first()->city->name}}
                                        </div>
                                    </div>

                                    <hr />

                                </div>
                                <div class="tab-pane fade" id="comment" role="tabpanel">

                                    @if (!$vet->comments->isEmpty())
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
                                    @else
                                        <p>Nikt jeszcze nie napisał komentarzu.</p>
                                    @endif
                                 
                                </div>
                                <div class="tab-pane fade" id="klinka" role="tabpanel">
                                    @if ($vet->clinics->isEmpty())
                                        <p>Możesz dodać klinikę</p>
                                    @else
                                        
                                   
                                    <h6>Twoje kliniki</h6>
                                    <br />
                                    @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                        <p>{{ \Session::get('success') }}</p>
                                    </div><br />
                                    @endif
                                    @foreach ($vet->clinics as $clinic)
                                    <p>Nazwa: {{$clinic->nazwa}}</p>
                                
                                <p>  <a href="{{$clinic->link}}">Podgląd</a>  
                                  <a data-deleteid={{$clinic->id}} data-toggle="modal" data-target="#delete"
                                    href="">Usuń</a>
                                    <a  href="{{ route("saveClinic",['id'=>$clinic->id])}}">Edytuj</a></p>
                            
                            
                                    @endforeach
                                    @endif
                                    <a class="btn button-vet mt-2" href="{{ route("saveClinic")}}"> Dodaj klinkę</a>
                                   
                                    
                                   
                                </div>
                                <div class="tab-pane fade" id="setting" role="tabpanel">

                                    <a class="mt-2" href="{{route('saveAdress')}}">Dodanie nowego adresu</a>
                                    <hr>
                                    <p>Planowany czas trwania wizyt: {{$vet->time_visit}} min.</p>
                                   
                                </div>

                                <div class="tab-pane fade" id="setting" role="tabpanel">

                                  
                                    <hr>
                                    <p>Planowany czas trwania wizyt</p>
                                    <form action="" method="post">
                                        <div class="form-group w-25">
                                        <select name="interval" id="interval" class="form-control">
                                        <option value="30">Domyślny</option>
                                        </select>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="map" role="tabpanel">
                                    <div class="col-md-4 col-6">


                                    </div>
                                    @php
                                    $i=1
                                    @endphp
                                    @foreach ($vet->locations as $location )

                                    <h6>Adres {{$i}}:</h6>



                                    <p> {{$location->address}}
                                     {{$location->city->name}} 
                                    </p>
                                    <p><a href="{{ route("saveAdress",['id'=>$location->id])}}">Edytuj Adres</a></p>
                                    <p> <a data-deleteid={{$vet->id}} data-toggle="modal" data-target="#showmap"
                                        href="">Pokaż na
                                        mapie</a>
                                      </p>
                                   
                                    <div id="div{{$i}}" >
                                        <div>
                                            <h6>Godziny otwarcia</h6>
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

                                <div class="tab-pane fade" id="service" role="tabpanel">
                                    <h6>Usługi</h6>
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
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="myModalLabel">Potwierdzienie usunięcia</h4>
                </div>
                <form action="{{route('deleteClinic')}}" method="post">

                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">
                            Czy napewno chcesz usunąć swoją klinię?
                        </p>
                        <input type="hidden" name="delete_id" id="delete_id" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-warning">Tak, Usuń</button>
                    </div>
                </form>
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