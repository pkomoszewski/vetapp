@extends('main')

@section('content')
<div class="container">
    <h2>Edytuj artykuł</h2>
    <form method="POST" class="form-horizontal" enctype="multipart/form-data"
        action="{{route('saveEditArticle',$article->id)}}">
        @csrf
        <fieldset>
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Tytuł</label>
                <div class="col-lg-10">
                    <input name="title" type="text" required class="form-control" value={{$article->title}}>
                </div>
            </div>
            <div class="form-group">
                <label for="textarea">Treść</label>
                <textarea class="form-control" id="textarea" rows="10" name="content">{{$article->content}}</textarea>
            </div>


            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <label for="vetPicture">Dodaj zdjęcie</label>
                    <input name="articlePicture" type="file" id="vetPicture">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">zapisz</button>
                </div>
            </div>



</div>

</fieldset>
</form>
</div>

@endsection