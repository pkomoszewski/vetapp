@extends('main')

@section('content')
<div class="container">
    <h2>Dodaj klinikę</h2>
    <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
        @csrf
        <fieldset>
            <div class="col-lg-6">
                <label for="name" class="col-lg-2 control-label">Nazwa</label>
                <input name="Nazwa" type="text" required class="form-control">
            </div>
            <div class="col-lg-6">
                <label for="name" class="col-lg-2 control-label">Email</label>
                <input name="Email" type="text" required class="form-control">
            </div>
            <div class="form-group">
                <label for="textarea">Opis</label>
                <textarea class="form-control" id="textarea" rows="10" name="opis"></textarea>
            </div>

            <div class="form-group">
                <label for="adres" class="col-lg-2 control-label">Adres</label>
                <div class="col-lg-6">
                    <input name="Adres" type="text" required class="form-control" id="adres" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="adres" class="col-lg-2 control-label">Miejscowosc</label>
                <div class="col-lg-6">
                    <input name="miejscowosc" type="text" required class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="numer" class="col-lg-2 control-label">Numer telefonu</label>
                <div class="col-lg-6">
                    <input name="Numer" type="text" required class="form-control" id="numer" value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <label for="numer" class="col-lg-5 control-label">Lokalizacja na mapie</label>
                    <input type="text" id="address-input" name="address_address" class="form-control map-input">
                    <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                    <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                </div>
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

                <div class="col-lg-6 col-lg-offset-2 d-flex">
                    <div class="col-md-6">
                        <input class="form-check-input" type="checkbox" name="whenOpen[{{ $i }}][key]" value={{$day}}>
                        <label class="form-check-label mr-2">
                            {{$day}}
                        </label>

                    </div>
                    <div class="col-md-6">
                        <input type="text" name="whenOpen[{{ $i }}][value]" class="form-control"
                            value="{{ old('whenOpen['.$i.'][value]') }}">
                    </div>


                </div>
                <?php $i++; ?>
                @endforeach
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-2">
                    <label for="ClinicPicture">Dodaj zdjęcie</label>
                    <input name="ClinicPicture" type="file" id="ClinicPicture">
                </div>

            </div>

            <div class="form-group mt-4">
                <div class="col-lg-6 col-lg-offset-2">
                    <button type="submit" class="btn button-vet">zapisz</button>
                </div>
            </div>

</div>




</div>

</fieldset>
</form>
</div>

@endsection

@section('scripts')
@parent
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
    async defer>
</script>


<script src="{{ asset('js/mapInput.js') }}"></script>

@stop