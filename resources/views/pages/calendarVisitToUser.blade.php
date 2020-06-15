
@extends('main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end m-3 ">
        <div >
            <p>Sortuj według:</p>

            <form  action=" {{ route('calendarVisitToUser',['owner_id'=>Auth::user()->owners->id ]) }}" class="form-inline" method="GET">
            <select class=" form-control ml-2" name="sortby" value="">
                <option > Domyślny</option>
                <option <?= (request('sortby') == "aty wizyty") ? "SELECTED" : "" ?>>Daty wizyty</option>
            </select>

            <button type=" submit" class="btn button-vet ml-3">Filtr</button>

            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default ">
                <div class="panel-body">

    @if ($reservations->isEmpty())
                    <div>Nie mam zaplanowanych wizyt</div>
    @else
                    @foreach($reservations as $reservation)
    
                    <div class="col-lg-4">
    
    
                        <div class="card mb-4">
    
    
                            <div class="card-body text-center">
                                <h5 class="card-title text-muted text-uppercase text-center"></h5>
    
                                <h6 class="card-text text-center">{{$reservation->day}} </h6>
                                <h6 class="card-text text-center">{{$reservation->hour}} </h6>
                                <h6 class="card-text text-center">Weterynarz: {{$reservation->vet->name}} </h6>
    
    
                                @if ($reservation->animal==null)
                                <td>Brak wybranego zwierzaka </td>
                                @else
                                <h6 class="card-text text-center">umówiony z {{$reservation->animal->imie}}
                                    @endif
    
    
                                    <p class="card-text text-center">{{$reservation->opis}} </p>
                                </h6>
    
                                <hr>
    
                                @if ($reservation->animal==null)
                                <td>Brak możliwości podejrzenia histori leczenia </td>
                                @else
                                <a href="{{ route('showHistoryTreatmeantAnimal',['id'=>$reservation->animal->id]) }}">
                                    <button class="btn btn-dark btn-xs">Historia Leczenia
                                    </button>
                                </a>
                                @endif
    
    
    
                            </div>
                            @auth
                            <div class="card-footer">
                                @if($reservation->status)
                                <p>Status: Potwierdzone</p>
                                @else
                                <p>Status: niepotwierdzone</p>
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


               
                  
 @endsection
