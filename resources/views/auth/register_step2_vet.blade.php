@extends('layouts.Frontend.main')

@section('content')
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content d-flex justify-content-center">
                <div class="signup-form">
                    <h2 class="form-title">Proszę o dokończenie konfiguracji konta</h2>
                    <form method="POST" class="register-form" id="register-form"
                        action="{{ route('register-step2post') }}">
                        @csrf

                        <div class="form-group">

                            <input type="text" name="imie" value="{{$vet->imie}}" placeholder="Imie" />

                        </div>
                        <div class="form-group">

                            <input type="text" name="nazwisko" value="{{$vet->nazwisko}}" placeholder="nazwisko" />
                        </div>

                        <div class="form-group">

                            <input type="text" name="opis" value="{{ old('Opis') }}" placeholder="Opis" />
                        </div>

                        <div class="form-group">

                            <input type="text" name="cena" value="{{ old('cena') }}" placeholder="Cena konsultacji" />
                        </div>
                        <div class="form-group">

                            <input type="text" name="numer" value="{{ old('numer') }}" placeholder="numer telefonu" />
                        </div>

                        <div class="form-group">

                            <input type="text" name="adres" value="{{ old('adres') }}" placeholder="adres" />
                        </div>

                        <div class="form-group">

                            <input type="text" id="citysearch" name="miejscowosc" value="{{ old('miejscowosc') }}"
                                placeholder="miejscowość" />
                        </div>
                        <div class="form-group">
                            <input type="text" id="address-input" name="address" placeholder="lokalizacja na mapie" />
                            <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                            <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                        </div>

                        <div id="address-map-container" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                        <div class="form-group">
                            <h6>Dni otwarcia</h6>

                            <?php 
                              $i=0;
                            $week=array('Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela');
                          
                            ?>
                            @foreach ($week as $day)

                            <div class="col-lg-12 col-lg-offset-2 d-flex">
                                <div class="col-md-6">
                                    <label for="thing{{$i}}" class="form-check-label mr-2">
                                        {{$day}}

                                    </label>
                                    <input class="form-check-input" type="checkbox" name="whenOpen[{{ $i }}][key]"
                                        value={{$day}} id="thing{{$i}}" />


                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="whenOpen[{{ $i }}][value]" class="form-control"
                                        value="{{ old('whenOpen['.$i.'][value]') }}" />
                                </div>


                            </div>
                            <?php $i++; ?>
                            @endforeach
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit"
                                value="Zakończ rejestracje" />
                        </div>

                        <br /><br />
                        <a href="{{ route('home') }}">Pomiń teraz</a>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>


@endsection

@section('scripts')
@parent
<script
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places&callback=initialize"
    async defer></script>



<script src={{ asset('js/mapInput.js') }/>
@stop