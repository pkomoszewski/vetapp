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

                <th>ilość użytkowników</th>

                <th>ilość właściciel</th>

                <th>ilość Klinic </th>
				<th>ilość Weterynarzy </th>
                <th>Ilość Wszystkich wizyt</th>
				<th>Ilość Ilość wszystkich komentarzy </th>

                  <th style="width: 36px;"></th>

            </tr>

        </thead>

        <tbody>

            <tr>

       

                <td>{{$user->id}}</td>

                <td>{{$user->email}}</td>

                <td>{{$user->vets->imie}}</td>

                <td>{{$user->vets->nazwisko}}</td>

                <td>{{$user->vets->adres}}</td>


            </tr>

     



        </tbody>

    </table>

</div>

@endsection