@extends('layouts.admin.backend')

@section('content')


<div class="well">



    <table class="table">
        <thead>
            <tr>

                <th>id</th>
                <th>Data wizyty</th>
                <th>godzina</th>
                <th>status</th>
                <th>opis</th>
                <th>pacjent (zwierze)</th>
                <th>właściel</th>
                <th colspan="2">Akcja</th>
            </tr>
        </thead>
        <tbody>


            @foreach ($reservations as $reservation)
            @isset($reservation)
            <tr>

                <td> {{$reservation->id}}</td>
                <td> {{$reservation->day}}</td>
                <td> {{$reservation->hour}}</td>

                @if ($reservation->status==true)
                <td> Potwierdzone</td>
                @else
                <td> Niepotwierdzone</td>
                @endif
                <td> {{$reservation->opis}}</td>

                @if ($reservation->animal==null)
                <td> inne</td>
                @else
                <td> {{$reservation->animal->imie}}</td>
                @endif
                <td> {{$reservation->owner->imie}}</td>

                @if($reservation->status==true)
                <td><a href="{{route('cancelReservationVet',$reservation->id)}}" class="btn btn-success">Anuluj
                        wizytę</a>
                </td>


                @else
                <td><a href="{{route('confirmReservationVet',$reservation->id)}}" class="btn btn-success">Potwierdz
                        wizytę</a>

                </td>
                @endif



                <td>
                    <button class="btn btn-danger" data-deleteid={{$reservation->id}} data-toggle="modal"
                        data-target="#delete">Usuń</button>

                </td>

            </tr>
            @endisset
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
            <form action="{{route('deleteVisit')}}" method="post">

                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        Czy napewno chcesz usunąć tą rezerwacje?
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