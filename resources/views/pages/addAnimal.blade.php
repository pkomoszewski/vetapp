@extends('main')

@section('content')
<div class="container">
    <h2>Dodaj swoje zwierzę</h2>
    <form method="POST" class="form-horizontal" enctype="multipart/form-data"
        action="{{ route('addNewAnimal',['id'=>Auth::user()->id]) }}">
        @csrf
        <fieldset>
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Imie</label>
                <div class="col-lg-10">
                    <input name="imie" type="text" required class="form-control" id="name">
                </div>
            </div>
            <div class="form-group">
                <label for="surname" class="col-lg-2 control-label">Gatunek</label>
                <div class="col-lg-10">
                    <input name="gatunek" type="text" required class="form-control" id="surname">
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn button-vet">Zapisz</button>
                </div>
            </div>

</div>

</fieldset>
</form>
</div>

@endsection