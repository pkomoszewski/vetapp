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
                <label for="adres" class="col-lg-2 control-label">Miejscowość</label>
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
                            value="{{ old('whenOpen['.$i.'][value]') }}"  placeholder="Godzina">
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
                            value="{{ old('services['.$i.'][price]') }}" id="priceserv{{$i}}" class="invisible" placeholder="Cena"/>
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

       
$('input[type="checkbox"]').change(function(){
  
    var id =$(this).attr('id');
    if ($(this).is(':checked')){
        console.log('siemka');
        $('#hourday'+id).removeClass('invisible');
        $('#price'+id).removeClass('invisible');
        }else{
        $('#hourday'+id).addClass('invisible');
        $('#price'+id).addClass('invisible');
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