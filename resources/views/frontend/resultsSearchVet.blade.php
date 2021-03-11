@extends('main')

@section('content')
<div class="container w-100 rounded" style="background-color: #eff2f8">
    <div class="row d-flex d-flex justify-content-between">
        <div class="m-2 p-2"><h6>Miejscowość: {{$city ?? ""}}</h6> </div>
      
            <div class="m-2">
    
                <form  action=" {{ route('Search') }}" class="form-inline" method="GET">
    
                <input name="city" placeholder="wyszukaj" type="hidden" value={{request('city')}} />
    
                <input name="choose" type="hidden" value={{request('choose')}} />
    
                <select class=" form-control ml-2" name="sortby" value="">
                    <option > Domyślny</option>
                    <option <?= (request('sortby') == "Ilości Opinii") ? "SELECTED" : "" ?>> Ilości Opinii</option>
    
                    <option <?= (request('sortby') == "Cena") ? "SELECTED" : "" ?>>Cena</option>
    
                </select>
    
                <button type=" submit" class="btn button-vet ml-3">Filtr</button>
    
                </form>
            </p>
    
            </div>
        
        

    </div>
   

  <div class="row  py-3 d-flex">
      <div class="col-4 order-2 "   style="position: relative;">
            <div  class="sticky-top " id="address-map" style="height:600px; width:100%; " >
              
            </div>
          </div>
        <div class="col">

            <div class="panel panel-default ">
                <div class="panel-body">

              

                    @if(!$results==null)
@php
$i=0;    
@endphp
                    @foreach ($results as $vet)
                    <div class="card mb-4">
                        <div class="card-body ">
                      
                            <div class="card-title mb-4">
                                <div class="row">
                                <div class="col-6">
                                <div class="d-flex justify-content-start">


                                    <div class="image-container mr-3">
                                        @if ($vet->photos->isEmpty())
                                        <img src="{{url('/images/person.png')}}" class="avatar avatar-s"
                                           >

                                        @else

                                        <img src="{{$vet->photos->first()->path}}" alt=""
                                            class="avatar  avatar-s" >
                                        @endif
                                   
                                    </div>
                                    <div class="userData ml-3">
                                       <div class="row d-block">
                                            <p>  <a href="{{ route('sitevet',['id'=>$vet->id]) }}">{{$vet->imie}} {{$vet->nazwisko}}</a>
                                                @if ($vet->weryfikacja)
                                                <i class="fa fa-check-circle-o"  data-toggle="tooltip" data-placement="top"  title="Zweryfikowany"></i>  
                                                
                                                @endif
                                              </p>
                                        
                                        <p>{{ucwords($vet->adres)}}</p>
                                        <p><i class="fas fa-money-bill-wave"></i> Cena konsultacji: </p>
                                        <p>{{$vet->cena_konsulatcji}} zł</p>
                                   <p>  {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>',
                                        $vet->averageRating()) !!}
                                        {{-- Mozna spróbowac przypisac zmiena do cache.  Dwa razy sie wykonuje zapytanie do bazy nie potrzebnie--}}
                                        {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 -
                                        $vet->averageRating()) !!}
                                         Opini {{$vet->comments->count()}}</p>
                                <p>{{ $vet->owners ?? 0 }}  osób lubli</p>
                                       
                                    </div>
                                 
                                   
                                        
                                    </div>
                                  
                                </div>
                              
                            </div>
                       
                        
                             

                                  
                             
                        </div>
                        @if (!$vet->opis=="")
                        <div class="row m-3">
                       <div class="mb-2">     <blockquote class="blockquote">
        <p style="font-size:15px" class="blockquote">   {{\Illuminate\Support\Str::words($vet->opis, 10,'....')}}
            <a href="{{ route('sitevet',['id'=>$vet->id]) }}">
               więcej</a>                  
        </p>
            </div>        
    
                            </blockquote>
                        </div> 
                        <div class="row-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link" id="about-tab" data-toggle="tab"   href=<?php $id ="#adres$i";echo $id; ?> role="tab"  >    Adres  </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="comment-tab" data-toggle="tab" href=<?php $id ="#comment$i"; echo $id;?> 
                                        role="tab">Ostatnie opinie</a>
                                </li>

                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id=<?php $id ="adres$i";echo $id;?> role="tabpanel">
                                 <p><i class="fas fa-map-marker-alt"></i> {{ $vet->locations->first()->address}}, {{ $vet->locations->first()->city->name}}
                                 <a href="{{$vet->locations->first()->Linkmap}}" class="printest"></i> Mapa</a></p>
                                 @if(Auth::guest())
                                 <p><a href="{{ route('login') }}">Zaloguj sie aby umówić się na wizyte</a>
                                 </p>
                                 @else
                                 <a href="{{ route('reservationscalendar',['vet_id'=>$vet->id,'location_id'=>$vet->locations->first()->id]) }}"
                                    class="btn btn-outline-primary">Umów się na
                                     wizytę</a>
                                 @endif
                                </div>
                                <div class="tab-pane fade" id=<?php $id ="comment$i"; echo $id;?>  role="tabpanel">
                                    <p>
                                     
                                     @if($vet->comments->isEmpty())
                                    Narazie brak opini.
                                    @else
                                    <i class="far fa-comment"></i>
                                    @php
                                    $array= $vet->comments->last();
                                     @endphp
                                     {{$array['content']}}
                                     @endif
                                       </p>
                                       
                                   </div>
                       
                            </div>
                        </div>
                        @endif
                        </div>
                    </div>
                    </div>
                    @php
                     $i++;   
                    @endphp
                    @endforeach
                    @else
                    <h6>Brak wyników wyszukiwania</h6>
                    @endif
                </div>

            </div>
                  
         </div>
             
     </div>
         
</div>
    

   
    <script>
   
   $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
     
   var adres="{{$city ?? 'Polska'}}"
       var map;
       var locations = <?php print_r(json_encode($results)) ?>;
       
                function initMap() {
                    geocoder = new google.maps.Geocoder();
                 
                   var map = new google.maps.Map(document.getElementById('address-map'), {
                 
                   disableDefaultUI: true,
                    scaleControl: true,
                    zoomControl: true,
              
                    
                styles:[ { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#6195a0" } ] }, { "featureType": "administrative.province", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [ { "lightness": "0" }, { "saturation": "0" }, { "color": "#f5f5f2" }, { "gamma": "1" } ] }, { "featureType": "landscape.man_made", "elementType": "all", "stylers": [ { "lightness": "-3" }, { "gamma": "1.00" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#bae5ce" }, { "visibility": "on" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 }, { "visibility": "simplified" } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "color": "#fac9a9" }, { "visibility": "simplified" } ] }, { "featureType": "road.highway", "elementType": "labels.text", "stylers": [ { "color": "#4e4e4e" } ] }, { "featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [ { "color": "#787878" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "transit.station.airport", "elementType": "labels.icon", "stylers": [ { "hue": "#0a00ff" }, { "saturation": "-77" }, { "gamma": "0.57" }, { "lightness": "0" } ] }, { "featureType": "transit.station.rail", "elementType": "labels.text.fill", "stylers": [ { "color": "#43321e" } ] }, { "featureType": "transit.station.rail", "elementType": "labels.icon", "stylers": [ { "hue": "#ff6c00" }, { "lightness": "4" }, { "gamma": "0.75" }, { "saturation": "-68" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#eaf6f8" }, { "visibility": "on" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#c7eced" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "lightness": "-49" }, { "saturation": "-53" }, { "gamma": "0.79" } ] } ]
                  });
                

             
geocoder.geocode( { 'address': adres}, function(results, status) {
  if (status == 'OK') {
    map.setCenter(results[0].geometry.location);
    map.setZoom(13);
  } else {
    console.log('błąd: ' + status);
  }
  if(adres=='Polska'){
    map.setZoom(5);
  }
});




                  $.each( locations, function( index, value ){
                    
                      var markerPlace = new google.maps.Marker({
  position: new google.maps.LatLng(value.locations[0].address_latitude, value.locations[0].address_longitude),
  map: map,

});

var infowindow = new google.maps.InfoWindow({
          content: '<p>'+value.locations[0].address+'</p>'+'<a href="/vet/'+value.locations[0].locationable_id+'">Podgląd</a>'
        });
google.maps.event.addListener(markerPlace, 'click', function() {
    infowindow.open(map, markerPlace);
     });


   });
   
                    }
                
   </script>
   </div>
   
   @endsection
   
   @section('javascript')
   
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY')}}&callback=initMap">
       async defer
   </script>
                    @endsection