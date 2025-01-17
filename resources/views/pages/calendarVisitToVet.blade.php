@extends('main')
@section('content')
<div class="container" style="background-color: #eff2f8; min-width:50vh; min-height:50vh">
    <div class="mt-2">
        @if ($reservations->isEmpty())
        <div class="m-2">
            <center>
                <h4 class="p-2">Nie ma aktualnie umówionych wizyt</h4>
        </center></div>

        @else

        <h6 class="p-2">Planowane wizyty pacjentów</h6>
    </div>
    <div class="d-flex justify-content-end m-3 ">
        
        <div >
    
            <form  action=" {{ route('calendarVisits',['user_id'=>Auth::user()->id ])  }}" class="form-inline" method="GET">
            
                <input name="choose" type="hidden" value={{request('choose')}} />
            <select class=" form-control ml-2" name="sortby" value="">
                <option > Domyślny</option>
                <option <?= (request('sortby') == "Daty wizyty") ? "SELECTED" : "" ?>>Daty wizyty</option>
                <option <?= (request('sortby') == "Potwierdzone") ? "SELECTED" : "" ?>>Potwierdzone</option>
                <option <?= (request('sortby') == "Niepotwierdzone") ? "SELECTED" : "" ?>>Niepotwierdzone</option>
            </select>

            <button type=" submit" class="btn button-vet ml-3">Filtr</button>

            </form>

        </div>
    </div>
    
    <div class="row">
        <div class="col-4 order-2 ">
            <div class="mt-5" style=" width:100%;  background-color: white" >
                <div class="p-3 d-block">
                  <a href="{{ route('historyVisits',['user_id'=>Auth::user()->id ]) }}"class="mb-2"><h6>Historia wizyt</h6></a>
                  <a href="{{ route('cancelvisitsite',['user_id'=>Auth::user()->id ]) }}" class="mb-2"><h6>Anulowane wizyty</h6></a>
    
    
             </div>
     
            </div>
          </div>

        <div class="col">

            <div class="panel panel-default ">
                <div class="panel-body d-flex  flex-column align-items-center">

                 
              
                    @foreach($reservations as $reservation)
    
                    <div class="col-12">
    
    
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
    
                                @if (!$reservation->animal==null && $reservation->status)
                                <hr>
                                <a href="{{ route('showformAddHistoryTreatmeantAnimal',['id'=>$reservation->animal->id]) }}"
                                    class="btn button-vet
                                     btn-xs top-buffer">Dodaj historie leczenia</a>
                                @endif
                              
                            </div>
                            @auth
                            <div class="card-footer text-center">
    
                                @if($reservation->status)
                                <p>Potwierdzone</p>
                                @else
                                <a href="{{ route('confirmReservationVet',['vet_id'=>$reservation->vet_id,'reservation_id'=>$reservation->id]) }}"
                                    class="btn button-vet
                                     btn-xs top-buffer">Potwierdź</a>
                                @endif
    
                                @if($reservation->status)
                                @else
                                <a href="{{ route('cancelReservationVet',['reservation_id'=>$reservation->id]) }}"
                                    class="btn button-vet
                                     btn-xs top-buffer">Anuluj</a>
                                @endif
    
                            </div>
                            @endauth
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