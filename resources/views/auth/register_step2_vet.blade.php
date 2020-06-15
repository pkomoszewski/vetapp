@extends('layouts.Frontend.main')

@section('content')
<div class="main">
    <section >
        <div class="container">
            <div class="d-flex justify-content-center">
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
                          
                            <textarea class="form-control" name="opis" id="exampleFormControlTextarea3" rows="7" placeholder="Opis"></textarea>
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
                            <input type="text" id="address-input" name="address_address" class="form-control map-input">
                            <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                            <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                        </div>

                        <div id="address-map-container" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                        <h6>Opcje wizyt</h6>

                     
                        <div class="form-vistis">
                        
                            <div class="col-lg-12 col-lg-offset-2 d-flex mb-2">
                                <div class="col-md-6">
                                    <div class="row ml-2">
                                        <input class="form-check-input" type="checkbox" name="visits"
                                        value="true" />
                                    <label for="visits" class="form-check-label mr-2">
                                        Wyjazdy do pacjentów
                                    </label>
                                    </div>
                                   
                                </div>
                
                            </div>
                       
                        </div>

                        <div class="col-lg-12 col-lg-offset-2 d-flex mb-2">

                              
                            <div class="col-md-6">
                                <div class="row ml-2">
                          
                             
<label for="interval">Czas planownej wizyty:</label>
                              
                                </div>
                            </div>
                            <div class="col-md-6">
                                <select name="interval" id="interval" class="form-control">
                                    <option value="30">Domyślny</option>
                                    </select>
                            </div>
                        </div>
                        

                        <div class="form-day">
                            <h6>Dni przyjmowania</h6>

                            <?php 
                              $i=0;
                            $week=array('Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela');
                          
                            ?>
                            @foreach ($week as $day)

                            <div class="col-lg-12 col-lg-offset-2 d-flex mb-2">

                              
                                <div class="col-md-6">
                                    <div class="row ml-2">
                                        <input class="form-check-input" type="checkbox" name="whenOpen[{{ $i }}][key]"
                                        value={{$day}} id="day{{$i}}" />
                                    <label for="thing{{$i}}" class="form-check-label mr-2">
                                        {{$day}}

                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="whenOpen[{{ $i }}][value]" id="hourday{{$i}}"
                                        value="{{ old('whenOpen['.$i.'][value]') }}"  class="invisible" placeholder="godzina otwarcia"/>
                                </div>
                            </div>
                            <?php $i++; ?>
                            @endforeach
                        </div>

                        <div class="form-service">
                            <h6>Twoje specjalizacje</h6>

                            
                            @foreach ($specializations as $specialization)

                            <div class="row-lg-12 row-lg-offset-2 d-flex mb-2">
                                <div class="col-md-6 ">
                                    <div class="row ml-2">

                                        <input class="form-check-input " type="checkbox" name="specializations[{{$i}}]"
                                        value="{{$specialization->name}}"/>
                                        <label for="specializations{{$i}}" class="form-check-label mr-2">
                                            {{$specialization->name}}
    
                                        </label>
                                    </div>
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
                                <div class="col-md-6 ">
                                    <div class="row ml-2">

                                        <input class="form-check-input serv" type="checkbox" name="services[{{ $i }}][kind]"
                                        value="{{$service}}" id="{{$i}}" />
                                        <label for="service{{$i}}" class="form-check-label mr-2">
                                            {{$service}}
    
                                        </label>
                                    </div>
                                  
                                   
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="services[{{ $i }}][price]"
                                        value="{{ old('services['.$i.'][price]') }}" id="price{{$i}}" class="invisible" placeholder="Cena"/>
                                </div>
                            </div>
                            <?php $i++; ?>
                            @endforeach

                           
                        </div>

                        <a class="text-primary" id="addService">Dodaj inne usługi</a>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit"
                                value="Zakończ rejestracje" />
                        </div>

                        <br /><br />
                        <a href="{{ route('home') }}" >Pomiń teraz</a>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
<script>
   
$('input[type="checkbox"]').change(function(){
    var id =$(this).attr('id');
    if ($(this).is(':checked')){
        $('#hour'+id).removeClass('invisible');
         $('#price'+id).removeClass('invisible');
        }else{
        $('#hour'+id).addClass('invisible');
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

for(i=5;i<=60;i=i+5){
         $('#interval').append($('<option>', {
    value: i,
    text: i+' min',
         
}));
    }
</script>


@endsection

@section('javascript')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="js/mapInput.js"></script>
@stop