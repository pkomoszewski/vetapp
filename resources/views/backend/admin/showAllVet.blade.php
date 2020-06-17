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
                <th>Adres</th>
                <th>Telefon</th>
                <th colspan="4">Akcja</th>


                <th style="width: 36px;"></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($vets as $vet)
            @foreach( $vet->users as $user)
            <tr>
                @isset($user->vets->imie)
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->vets->imie}}</td>
                <td>{{$user->vets->nazwisko}}</td>
                <td>{{$user->vets->adres}}</td>
                @if(!$user->vets->phone==null)
                <td>{{$user->vets->phone->numer}}</td>
                @else
                <td>-</td>
                @endif
                <td><a href="{{ route('sitevet',$user->vets->id) }}" class="btn btn-success">Podgląd</a> </td>
                @if(!$user->vets->weryfikacja)
                <td><a href="{{route('verifyVet', $user->vets->id)}}" class="btn btn-warning">Zweryfikuj</a>

                </td>
                @endif
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
                @endisset

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
                        Czy napewno chcesz usunąć tego weterynarza?
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