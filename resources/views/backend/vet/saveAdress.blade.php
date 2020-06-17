@extends('main')

@section('content')
<div class="container">
    @if( $address ?? false )
    <h2>Edycja adresu: {{ $address->address }}</h2>
    @else
    <h2>Dodaj nowy adres</h2>
    @endif
   
    <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
        @csrf
        <fieldset>
            <div class="form-group">
                <label for="adres" class="col-lg-2 control-label">Adres</label>
                <div class="col-lg-6">
                    <input name="adres" type="text" required class="form-control" id="adres" value="{{$address->address ?? old('adres')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="adres" class="col-lg-2 control-label">Miejscowość</label>
                <div class="col-lg-6">
                    <input name="miejscowosc" type="text" required class="form-control" value="{{$address->city->name ?? old('miejscowosc')}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <label for="numer" class="col-lg-5 control-label">Lokalizacja na mapie</label>
                    <input type="text" id="address-input" name="address_address" class="form-control map-input">
                    <input type="hidden" name="address_latitude" id="address-latitude" value="{{$address->address_latitude ?? 0}} " />
                    <input type="hidden" name="address_longitude" id="address-longitude" value="{{$address->address_longitude ?? 0}}" />
                </div>
            </div>

            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>

            <div class="form-group  mt-2">
                <h6>Dni otwarcia</h6>

                <?php 
                  $i=0;
                $week=array('Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela');
              
                ?>
                @foreach ($week as $day)

                <div class="col-lg-6 col-lg-offset-2 d-flex mb-2">
                    <div class="col-md-3">
                        <input class="form-check-input" type="checkbox" name="whenOpen[{{ $i }}][key]" value={{$day}} id="{{$i}}">
                        <label class="form-check-label mr-2">
                            {{$day}}
                        </label>

                    </div>
                    <div class="col-md-3">
                        <input type="text" name="whenOpen[{{ $i }}][value]"  class="invisible" id="hourday{{$i}}"
                        value="{{$address->whenOpen[$i]['value'] ?? old('whenOpen['.$i.'][value]')}} "  placeholder="Godzina">
                    </div>


                </div>
                <?php $i++; ?>
                @endforeach
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
<script>
$("[id^='hourday']").each(function(){
        var id =$(this).attr('id');
       id= id.replace('hourday','');

        if($(this).val().length >= 10){
           
            $("[id='"+id+"']").prop( "checked", true ); 
            $(this).removeClass('invisible');
        } else{
            $(this).addClass('invisible');
        }
        
    });

    $('input[type="checkbox"]').change(function(){
  
  var id =$(this).attr('id');
  if ($(this).is(':checked')){
      
      $('#hourday'+id).removeClass('invisible');
     
    
      }else{
      $('#hourday'+id).addClass('invisible');
      $('#hourday'+id).val('');
   
  }

  

});
</script>
@endsection

@section('javascript')
@parent
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
    async defer>
</script>


<script src="{{ asset('js/mapInput.js') }}"></script>

@stop