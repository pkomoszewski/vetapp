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
                <th>ilość Weterynarzy </th>
                <th>ilość Klinic </th>
                <th>Ilość Ilość wszystkich komentarzy </th>

                <th style="width: 36px;"></th>

            </tr>

        </thead>

        <tbody>

            <tr>



                <td>{{$countUser}}</td>
                <td>{{$countOwner}}</td>
                <td>{{$countVet}}</td>
                <td>{{$countClinic}}</td>
                <td>{{$countComment}}</td>


            </tr>





        </tbody>

    </table>

</div>

@endsection