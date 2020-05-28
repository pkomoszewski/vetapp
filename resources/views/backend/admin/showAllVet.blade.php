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
                <th>Nazwisko</th>
                <th>Data dodania</th>
                <th colspan="3">Akcja</th>


                <th style="width: 36px;"></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($vets as $vet)
            @foreach( $vet->users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->vets->imie}}</td>
                <td>{{$user->vets->nazwisko}}</td>
                <td>{{$user->vets->adres}}</td>
                <td>{{$user->vets->phone}}</td>

                <td><a href="" class="btn btn-success">Zadss</a> </td>
                @if($user->ban)
                <td><a href="{{route('banUser', $user->id)}}" class="btn btn-warning">Odblokuj</a></td>
                @endif

                @if(!$user->ban)
                <td><a href="{{route('banUser', $user->id)}}" class="btn btn-info">Zablokuj</a>

                </td>
                @endif


                <td><a href=" {{route('deleteUser', $user->id)}}" class="btn btn-danger">Usuń</a> </td>

                <td>
                    <a href="user.html"><i class="icon-pencil"></i></a>
                    <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
                </td>
            </tr>
            @endforeach
            @endforeach

        </tbody>
    </table>
</div>
<div class="pagination">
    dodoc paginacje
</div>
<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text">Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
    </div>
</div>

@endsection