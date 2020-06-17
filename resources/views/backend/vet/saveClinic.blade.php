@extends('main')

@section('content')
<div class="container">
  @if( $clinic ?? false )
<h2>Edycja kliniki: {{ $clinic->nazwa }}</h2>
@else
<h2>Dodanie nowej kliniki</h2>
@endif
    <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="">
        @csrf
        <fieldset>
            <div class="col-lg-6">
                <label for="name" class="col-lg-2 control-label">Nazwa</label>
                <input name="Nazwa" type="text" required class="form-control" value="{{$clinic->nazwa ?? old('Nazwa')}}">
            </div>
            <div class="col-lg-6">
                <label for="name" class="col-lg-2 control-label">Email</label>
                <input name="Email" type="text" required class="form-control" value="{{$clinic->email ?? old('Email')}}">
            </div>
            <div class="form-group">
                <label for="textarea">Opis</label>
                <textarea class="form-control" id="textarea" rows="10" name="opis">{{$clinic->opis ?? old('Opis')}}</textarea>
            </div>

            <div class="form-group">
                <label for="adres" class="col-lg-2 control-label">Adres</label>
                <div class="col-lg-6">
                    
                    <input name="Adres" type="text" required class="form-control" id="adres" value="{{$clinic->location->address ?? old('Adres')}}">
                </div>
            </div>

            <div class="form-group">
                <label for="adres" class="col-lg-2 control-label">Miejscowość</label>
                <div class="col-lg-6">
                    <input name="miejscowosc" type="text" required class="form-control"  value="{{$clinic->location->city->name ?? old('Miejscowosc')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="numer" class="col-lg-2 control-label">Numer telefonu</label>
                <div class="col-lg-6">
                    <input name="Numer" type="text" required class="form-control" id="numer" value="{{$clinic->phone->numer ?? old('Numer')}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <label for="numer" class="col-lg-5 control-label">Lokalizacja na mapie</label>
                    <input type="text" id="address-input" name="address_address" class="form-control map-input">
                    <input type="hidden" name="address_latitude" id="address-latitude" value="{{$clinic->location->address_latitude ?? 0}} " />
                    <input type="hidden" name="address_longitude" id="address-longitude" value="{{$clinic->location->address_longitude ?? 0}}" />
                </div>
            </div>

            <div id="address-map-container " style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>

            <div class="form-group mt-2">
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
                            value="{{$clinic->location->whenOpen[$i]['value'] ?? old('whenOpen['.$i.'][value]')}} "  placeholder="Godzina">
                    </div>


                </div>
                <?php $i++; ?>
                @endforeach
            </div>
            <div class="form-service">
                <h6>Świadczone usługi</h6>

                <?php 
                  $i=0;
                $services=array("Antykoncepcja","Badanie trychinoskopowe mięsa","Cesarskie cięcie","Czipowanie","Drobny zabieg chirurgiczny","Drobny zabieg w znieczuleniu","Eutanazja",
                "Inseminacja","Kastracja","Leczenie złamań","Odrobaczanie","Paszporty dla zwierząt","Przyjmowanie porodu (za godz.)","Sterylizacja","Szczepienie","Usuwanie kamienia nazębnego","Usuwanie kleszczy","Znieczulenie ogólne");
              
                ?>
                @foreach ($services as $service)

                <div class="row-lg-12 row-lg-offset-2 d-flex mb-2">
                    <div class="col-md-3 ">
                        <div class="row ml-2">

                            <input class="form-check-input serv" type="checkbox" name="services[{{ $i }}][kind]"
                            value="{{$service}}" id="serv{{$i}}" />
                            <label for="service{{$i}}" class="form-check-label mr-2">
                                {{$service}}

                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="services[{{ $i }}][price]"
                            value="{{ $clinic->service->services[$i]['price'] ?? old('services['.$i.'][price]') }}" id="priceserv{{$i}}" class="invisible" placeholder="Cena"/>
                    </div>
                </div>
                <?php $i++; ?>
                @endforeach

               
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-2">
                    <label for="ClinicPicture">Dodaj zdjęcie</label>
                   <input type="file" name="objectPictures[]" id="objectPictures" multiple>
                </div>

            </div>
            @if( $clinic ?? false ) 
            <div class="col-lg-10 col-lg-offset-2">
    
                @foreach( $clinic->photos->chunk(4) as $chunked_photos ) 
    
                    <div class="row">
    
    
                        @foreach( $chunked_photos as $photo )
    
                            <div class="col-md-3 col-sm-6">
                                <div class="thumbnail w-20" >
                                    <img class="img-fluid" src="{{ $photo->path ?? $placeholder }}" alt="...">
                                    <div class="mt-2">
                                        <p><a href="{{ route('deletePhoto',['id'=>$photo->id])}}" >Usuń</a></p>
                                    </div>
    
                                </div>
                            </div>
    
                        @endforeach 
    
                    </div>
    
    
                @endforeach 
    
            </div>
@endif    
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

    $("[id^='priceserv']").each(function(){
        var id =$(this).attr('id');
       id= id.replace('priceserv','');
 
        if($(this).val()){
            $( "#serv"+id ).prop( "checked", true ); 
            $(this).removeClass('invisible');
        } else{
            $('#price'+id).addClass('invisible');
        }
        
    });

    $('input[type="checkbox"]').change(function(){
  
  var id =$(this).attr('id');
  if ($(this).is(':checked')){
      
      $('#hourday'+id).removeClass('invisible');
      $('#price'+id).removeClass('invisible');
    
      }else{
      $('#hourday'+id).addClass('invisible');
      $('#price'+id).addClass('invisible');
      $('#hourday'+id).val('');
      $('#price'+id).val('');
  }

  

})
    

$("#addService").click(function(){
    var id=$(".serv:last").attr('id');
    id++;
console.log(id);
var input ="<div class='row-lg-12 row-lg-offset-2 d-flex mb-2'><div class='col-md-6 mr-2' >  <input type='text' name='services['"+id+"'][kind]' class='serv' placeholder='rodzja usługi' id='"+id+"'  /> </div>   <div class='col-md-6'><input type='text' placeholder='Cena' name='services['"+id+"'][price]'/></div></div>"
$('.form-service').append(input); 
  

})
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