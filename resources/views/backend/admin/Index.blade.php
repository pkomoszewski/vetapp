@extends('layouts.admin.backend')

@section('content')


<div class="well">
    <br />
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div><br />
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Email</th>
                <th>Imie</th>
                <th>Data dodania</th>
                <th colspan="2">Akcja</th>


                <th style="width: 36px;"></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($owners as $owner)
            @foreach( $owner->users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->owners->imie}}</td>
                <td>{{$user->owners->TimeCreated}}</td>
             
                @if($user->ban)
                <td><a href="{{route('banUser', $user->id)}}" class="btn btn-warning">Odblokuj</a></td>
                @endif

                @if(!$user->ban)
                <td><a href="{{route('banUser', $user->id)}}" class="btn btn-info">Zablokuj</a>

                </td>
                @endif
                <td>
                    <button class="btn btn-danger" data-deleteid={{$user->id}} data-toggle="modal"
                        data-target="#delete">Usuń</button>

                </td>

              
            </tr>
            @endforeach
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
            <form action="{{route('deleteUser')}}" method="post">

                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        Czy napewno chcesz usunąć tego użytkownika?
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