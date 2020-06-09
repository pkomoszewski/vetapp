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
                                        href="{{ route('profile',['user'=>Auth::user()->id]) }}"> Edycja
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
                                    <a class="nav-link" id="map-tab" data-toggle="tab" href="#klinka" role="tab">Klinka
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel">


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Imie i Nazwisko</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{$vet->name}}

                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Numer telefonu</label>
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
                                            <label style="font-weight:bold;">Opis</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            @if ($vet->opis=='')
                                            <p>Brak opisu. Proszę o wypełnienie</p>
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
                                </div>
                                <div class="tab-pane fade" id="klinka" role="tabpanel">

                                    <a class="btn button-vet mt-2" href="{{ route("addClinic")}}"> Dodaj klinkę</a>
                                </div>
                                <div class="tab-pane fade" id="setting" role="tabpanel">

                                    <a class="btn button-vet mt-2" href="{{route('addAdress')}}"> Dodaj adres</a>
                                </div>
                                <div class="tab-pane fade" id="map" role="tabpanel">
                                    <div class="col-md-4 col-6">


                                    </div>
                                    @php
                                    $i=1
                                    @endphp
                                    @foreach ($vet->locations as $location )

                                    <h6>Adres {{$i}}</h6>



                                    <p> {{$location->address}}</p>
                                    <p> {{$location->city->name}}</p>
                                    <div id="div{{$i}}" class=" data">
                                        <div>

                                            <a data-deleteid={{$vet->id}} data-toggle="modal" data-target="#delete"
                                                href="">Pokaż na
                                                mapie</a>
                                        </div>
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


                            </div>
                        </div>
                    </div>


                </div>

            </div>



        </div>
    </div>

    <script>
        var map;
function initMap() {
var uluru = {lat: {{$vet->address_latitude}}, lng: {{$vet->address_longitude}}};
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