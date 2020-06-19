@extends('main')

@section('content')

<div class="container">
    <h2>Podstawowe dane Weterynarza</h2>
    <form method="POST" action="{{ route('editProfile',['user'=>Auth::user()->id]) }}" class="form-horizontal"
        enctype="multipart/form-data">

        @csrf
        <fieldset>
            <div class="form-group">
                <label for="email" class="col-lg-2 control-label">Email:</label>
                <div class="col-lg-10">
                    <input name="email" type="text"  class="form-control" id="email"
                        value="{{$user->email}}">
                </div>
            </div>


            <div class="form-group">
                <label for="numer" class="col-lg-2 control-label">Numer telefonu:</label>
                <div class="col-lg-10">
                    <input name="numer" type="text"  class="form-control" id="numer"
                        value="{{$user->vets->phone->numer ?? null}}">
                </div>
            </div>

            <div class="form-group">
                <label for="opis" class="col-lg-2 control-label">Opis:</label>
                <div class="col-lg-10">
                    <textarea class="form-control" id="textarea" rows="10" name="opis">{{$user->vets->opis}}</textarea>

                </div>
            </div>

            <div class="form-group">
                <label for="cena" class="col-lg-2 control-label">Cena podstawowej konsultacji:</label>
                <div class="col-lg-10">
                    <input name="cena" type="text"  class="form-control" id="cena"
                        value="{{$user->vets->cena_konsulatcji}}" placeholder="Cena">
                </div>
            </div>
            
            <div class="form-group">
                <label for="cena" class="col-lg-2 control-label">Planowany czas wizyty:</label>
                <div class="col-lg-10">
                    <select name="interval" id="interval" class="form-control">
                        <option value="{{$user->vets->time_visit}}">{{$user->vets->time_visit}} min</option>
                        </select>
                </div>
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
                            value="{{ $user->vets->service->services[$i]['price'] ?? old('services['.$i.'][price]') }}" id="priceserv{{$i}}" class="invisible" placeholder="Cena"/>
                    </div>
                </div>
                <?php $i++; ?>
                @endforeach

               
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn button-vet">Zapisz</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <label for="vetPicture">Dodaj zdjęcie</label>
                    <input name="vetPicture" type="file" id="vetPicture">
                </div>
            </div>
            @if($user->vets->photos==null)
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail w-20" >
                    <img class="img-fluid" src="{{$user->vets->photos->first()->path ?? ''}}" alt="...">
                    <div class="mt-2">
                        <p><a href="{{ route('deletePhoto',['id'=>$user->vets->photos->first()->id])}}" >Usuń</a></p>
                    </div>

                </div>
            </div>
            @endif


        </fieldset>

    </form>
</div>
<script>

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
      
      $('#price'+id).removeClass('invisible');
    
      }else{
      $('#price'+id).addClass('invisible');
      $('#price'+id).val('');
  }
})
for(i=5;i<=60;i=i+5){
         $('#interval').append($('<option>', {
    value: i,
    text: i+' min',
         
}));
    }
</script>
@endsection