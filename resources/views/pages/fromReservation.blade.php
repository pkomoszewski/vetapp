@extends('main')

@section('content')

<div class="container">
    <h2>Umawianie wizyty</h2>
    <form method="POST" action="{{ route('confirmReservation',['vet_id'=>$vet_id]) }}" class="form-horizontal"
        enctype="multipart/form-data">

        @csrf
        <fieldset>

            <div class="form-group">
                <label class="col-lg-2 control-label">Dla kogo umawiasz wizytę?</label>
                <div class="col-lg-10">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected>Wybierz..........</option>


                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="imie" class="col-lg-2 control-label">Imie</label>
                <div class="col-lg-10">
                    <input name="imie" type="text" required class="form-control" id="name"
                        value="{{Auth::user()->owners->imie}}">
                </div>
            </div>
            <div class="form-group">
                <label for="nazwisko" class="col-lg-2 control-label">Nazwisko</label>
                <div class="col-lg-10">
                    <input name="nazwisko" type="text" required class="form-control" id="surname"
                        value="{{Auth::user()->owners->nazwisko}}">
                </div>
            </div>


            <div class="form-group">
                <label for="numer" class="col-lg-2 control-label">Numer telefonu</label>
                <div class="col-lg-10">
                    <input name="numer" type="text" required class="form-control" id="numer" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Inforamacje dla weterynarza</label>
                <div class="col-lg-10">
                    <input name="opis" type="textarea" required class="form-control" id="surname" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Termin</label>
                <div class="col-lg-10">
                    <input name="data" type="textarea" required class="form-control" id="surname" value="{{$data}}"
                        readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Godzina</label>
                <div class="col-lg-10">
                    <input name="godzina" type="textarea" required class="form-control" id="surname" value="{{$ts}}"
                        readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Następny krok</button>
                </div>
            </div>




        </fieldset>

    </form>
</div>

@endsection