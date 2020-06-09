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
                <th>Nazwa</th>
                <th>Email</th>
                <th>Właściciel</th>
                <th colspan="3">Akcja</th>


                <th style="width: 36px;"></th>
            </tr>
        </thead>
        <tbody>


            @foreach( $clinics as $clinic)
            <tr>
                <td>{{$clinic->id}}</td>
                <td>{{$clinic->nazwa}}</td>
                <td>{{$clinic->email}}</td>
                <td>{{$clinic->vet->Name}}</td>

                <td><a href="{{ route('siteclinic',['id'=>$clinic->id]) }}" class="btn btn-success">Podgląd</a></td>
                @if($clinic->status)
                <td><a href="{{route('StatusClinic', $clinic->id)}}" class="btn btn-warning">Zablokuj</a></td>
                @endif

                @if(!$clinic->status)
                <td><a href="{{route('StatusClinic', $clinic->id)}}" class="btn btn-info">Potwierdzenie</a>
                </td>
                @endif
                <td>
                    <button class="btn btn-danger" data-deleteid={{$clinic->id}} data-toggle="modal"
                        data-target="#delete">Usuń</button>

                </td>
                <td>
                    <a href="clinic.html"><i class="icon-pencil"></i></a>
                    <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
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
            <form action="{{route('deleteClinic')}}" method="post">

                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        Czy napewno chcesz usunąć tą klinikę?
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