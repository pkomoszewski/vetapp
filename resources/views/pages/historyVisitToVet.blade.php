@extends('main')
@section('content')
<div class="container" style="background-color: #eff2f8; min-width:50vh; min-height:50vh">
    <div class="mt-2">
        @if ($reservations->isEmpty())
        <div class="m-2">
            <center>
                <h4 class="p-2">Brak</h4>
        </center></div>

        @else

        <h6 class="p-2">Historie wizyt</h6>
    </div>
    <div class="d-flex justify-content-end m-3 ">
        
        <div >
    
            <form  action=" {{ route('Search') }}" class="form-inline" method="GET">
            
                <input name="choose" type="hidden" value={{request('choose')}} />
            <select class=" form-control ml-2" name="sortby" value="">
                <option > Domyślny</option>
                <option <?= (request('confirm') == "Ilości Opinii") ? "SELECTED" : "" ?>> Po dacie</option>
                <option <?= (request('sortby') == "Cena") ? "SELECTED" : "" ?>>Niepotwierdzone</option>
            </select>

            <button type=" submit" class="btn button-vet ml-3">Filtr</button>

            </form>

        </div>
    </div>
    
    <div class="row">
        <div class="col">

            <div class="panel panel-default ">
                <div class="panel-body d-flex  flex-column align-items-center">

                 
              
                    @foreach($reservations as $reservation)
    
                    <div class="col-8">
    
    
                        <div class="card mb-4">
    
    
                            <div class="card-body text-center">
                                <h5 class="card-title text-muted text-uppercase text-center"></h5>
    
                                <h6 class="card-text text-center">{{$reservation->day}} </h6>
                                <h6 class="card-text text-center">{{$reservation->hour}} </h6>
                                <h6 class="card-text text-center">Miejsce wizyty: {{$reservation->location->address}} </h6>
                                <h6 class="card-text text-center">Właściciel: {{$reservation->owner->imie}} {{$reservation->owner->nazwisko}} </h6>
                                @isset($reservation->phone->numer)
                                <h6 class="card-text text-center">Telefon : {{$reservation->phone->numer}} </h6>
                                @endisset
                               
                                
                                @if (!$reservation->animal==null)
                                <h6 class="card-text text-center">{{$reservation->animal->imie}} </h6>
                                @else
                                <h6 class="card-text text-center">Brak informacji o pacjencie</h6>
                                @endif
                                <p class="card-text text-center">{{$reservation->opis}} </p>
                                </h6>
    
                              
                              
                            </div>
                           
                        </div>
                    </div>
                    @endforeach
                    @endif
              
                </div>
            </div>
        </div>
    </div>
</div>
                  
@endsection