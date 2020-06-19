
@extends('main')

@section('content')
<div class="container " style="background-color: #eff2f8; min-width:50vh; min-height:50vh">
    <div class="mt-2">
        @if ($reservations->isEmpty())
        <div class="p-5">
            <center>
            <h6>Nie mam zaplanowanych wizyt</h6>
        </center></div>

        @else
        <h6 class="p-2">Moje wizyty</h6>
    </div>
    <div class="d-flex justify-content-end m-3 ">
        <div >
            <form  action=" {{ route('calendarVisitToUser',['owner_id'=>Auth::user()->owners->id ]) }}" class="form-inline" method="GET">
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
        <div class="col-12">

            <div class="panel panel-default ">
                <div class="panel-body d-flex flex-column justify-content-center " >

   
   
                    @foreach($reservations as $reservation)
    
                    <div class="col-8">
    
    
                        <div class="card mb-4">
    
    
                            <div class="card-body text-center">
                                <h5 class="card-title text-muted  text-center">Wizyta</h5>
    
                                <h6 class="card-text text-center">{{$reservation->day}} </h6>
                                <h6 class="card-text text-center">{{$reservation->hour}} </h6>
                                <h6 class="card-text text-center">Weterynarz: {{$reservation->vet->name}} </h6>
                                <a href="{{$reservation->vet->link}}">Podgląd</a>
                                <h6 class="card-text text-center">Telefon: {{$reservation->vet->phone->numer}} </h6>
                                <h6 class="card-text text-center">Adres: {{$reservation->location->address}} </h6>
                                <p><a href="{{$reservation->location->Linkmap}}"><strong> mapa</strong></a></p>
    
                                @if ($reservation->animal==null)
                                <td>Brak wybranego zwierzaka </td>
                                @else
                               umówiony z  <h6 class="card-text text-center">{{$reservation->animal->imie}}</h6>
                                    @endif
    
                             <h6 class="card-text text-center">Opis:</h6>
                                    <p class="card-text text-center">{{$reservation->opis}} </p>
                                </h6>
    
                                <hr>
    
                                @if ($reservation->animal==null || $reservation->status==false)
                                <td>Brak możliwości podejrzenia histori leczenia </td>
                                @else
                                <a href="{{ route('showHistoryTreatmeantAnimal',['id'=>$reservation->animal->id]) }}">
                                    <button class="btn button-vet btn-xs">Historia Leczenia
                                    </button>
                                </a>
                                @endif
    
    
    
                            </div>
                            @auth
                            <div class="card-footer">
                                @if($reservation->status)
                                <p class="text-success">Status: Potwierdzone</p>
                                @else
                                <p class="text-danger">Status: niepotwierdzone</p>
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
