@extends('main')

@section('content')

<div class="container">
    <h2>Dane użytkownika</h2>
    <form method="POST" class="form-horizontal" enctype="multipart/form-data">
        <fieldset>
            <div class="form-group">
                <label for="imie" class="col-lg-2 control-label">Imię</label>
                <div class="col-lg-10">
                    <input name="name" type="text" required class="form-control" id="name">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input name="email" type="email" required class="form-control" id="inputEmail">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-dark">Zapisz</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <label for="userPicture">Dodaj swoje zdjecie</label>
                    <input name="userPicture" type="file" id="userPicture">
                </div>
            </div>

            <div class="col-lg-10 col-lg-offset-2">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">
                            <img class="img-responsive"
                                src="http://lorempixel.com/275/150/people/?x=<?= mt_rand(1, 9999999) ?>" alt="...">
                            <div class="caption">
                                <p><a href="#" class="btn btn-dark btn-xs" role="button">Delete</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>
    </form>
</div>

@endsection