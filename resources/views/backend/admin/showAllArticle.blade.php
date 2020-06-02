@extends('layouts.admin.backend')

@section('content')


<div class="well">
    <br />
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div><br />
    @endif
    <a href="{{route('newArticle')}}" class="btn btn-success m-2">Dodaj</a>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Tytul</th>
                <th>Data dodania</th>
                <th colspan="3">Akcja</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($articles as $article)

            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->TimeCreated}}</td>


                <td><a href="{{route('showArticle', $article->id)}}" class="btn btn-warning">Podgląd</a></td>
                <td><a href="{{route('showEditArticle',$article->id)}}" class="btn btn-info">Edytuj</a></td>
                <td>
                    <button class="btn btn-danger" data-deleteid={{$article->id}} data-toggle="modal"
                        data-target="#delete">Usuń</button>

                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">Potwierdzienie usunięcia</h4>
            </div>
            <form action="{{route('deleteArticle')}}" method="post">

                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        Czy napewno chcesz usunąć ten artykuł?
                    </p>
                    <input type="hidden" name="delete_id" id="delete_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-warning">Tak, Usuń</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection