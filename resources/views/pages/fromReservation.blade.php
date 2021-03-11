@extends('layouts.Backend.main')

@section('content')

<div class="container w-100" style="background-color: #eff2f8">


<div class="row">
    <div class="col-4 order-2 ">
        <div class="mt-5"id="address-map" style=" width:100%; background-color: white" >
            <div class="p-3">
                <h6>Szczegóły rezerwacji</h6>
                <p><h6>Termin:</h6> {{$data}}</p>
                <p><h6>Godzina:</h6> {{$ts}}</p>
                <p><h6>Adres:</h6> {{$location->address}}, {{$location->city->name}} </p>
                <hr/>
                <div class="media">
                    <div class="media-left padding-right-2">
                        <div class="avatar" >

                            @if($vet->photos->isEmpty())
                            <img src="{{asset('/images/person.png')}}" class="avatar avatar-xs"/>

                            @else
                            <img src="{{$vet->photos->first()->path}}" class="avatar avatar-xs"
                         />
                            @endif
                        </div>
                    </div>
                    <div class="media-body ml-2">
                        <div><strong>wet.</strong>  {{$vet->name}}</div>
                    </div>
                </div>



            </div>
 
        </div>
      </div>
    <div class="col mt-3">
    <h2 class="p-2">Rezerwacja wizyty</h2>
    <form method="POST" action="{{ route('confirmReservation',['vet_id'=>$vet->id]) }}" class="form-horizontal"
        enctype="multipart/form-data">

        @csrf
        <fieldset>

            <div class="form-group">
                <label class="col-lg-4 control-label">Dla kogo umawiasz wizytę?</label>
                <div class="col-lg-10">
                    @if(!Auth::user()->owners->animals->isEmpty())
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="animal">

                        @foreach(Auth::user()->owners->animals as $animal)
                        <option value="{{ $animal->id }} ">
                            {{$animal->imie}}
                        </option>
                        @endforeach

                    </select>
                    @else
                   <em> Brak zwierzat do wyboru<em>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="imie" class="col-lg-2 control-label">Imię:</label>
                <div class="col-lg-10">
                    <input name="imie" type="text" required class="form-control" id="name"
                        value="{{Auth::user()->owners->imie}}">
                </div>
            </div>
            <div class="form-group">
                <label for="nazwisko" class="col-lg-3 control-label">Nazwisko:</label>
                <div class="col-lg-10">
                    <input name="nazwisko" type="text" required class="form-control" id="nazwisko"
                        value="{{Auth::user()->owners->nazwisko}}">
                </div>
            </div>


            <div class="form-group">
                <label for="numer" class="col-lg-3 control-label">Numer telefonu:</label>
                <div class="col-lg-10">
                    <input name="numer" type="text" required class="form-control" id="numer" value="" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Inforamacje dla weterynarza:</label>
                <div class="col-lg-10">
                    <input name="opis" type="textarea" required class="form-control" value="">
                    <input name="data" type="text" required class="invisible"   value="{{$data}}"
                    readonly>
                    <input name="godzina" type="text" required class="invisible"  value="{{$ts}}"
                        readonly>
                        <input name="location" type="number" required class="invisible"  value="{{$location->id}}"
                        readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn button-vet">Zapisz się</button>
                </div>
            </div>
        </fieldset>

    </form>
</div>
</div>
</div>

@endsection