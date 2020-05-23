@extends('main')

@section('content')
<div class="container">
    <h2>Dodaj historie leczenia</h2>
    <form method="POST" class="form-horizontal" enctype="multipart/form-data"
        action="{{route('addNewHistoryTreatmeantAnimal',['id'=>$animal_id]) }}">
        @csrf
        <fieldset>

            <div class="form-group">
                <label for="textarea">Opis</label>
                <textarea class="form-control" id="textarea" rows="10" name="opis"></textarea>
            </div>
            <label for="name" class="col-lg-2 control-label">Cena</label>
            <div class="col-lg-10">
                <input name="cena" type="text" required class="form-control">
            </div>
            <div class="form-group mt-4">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-dark">zapisz</button>
                </div>
            </div>

</div>




</div>

</fieldset>
</form>
</div>

@endsection