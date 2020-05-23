@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <p>rachunek za całe leczenie: {{ $totalbill }} zł</p>

                    @foreach ($histories as $history)
                    <div class="row">
                        <div class="container mt-5">
                            <div class="card">

                                <div class="row">
                                    <div class="col-3">

                                    </div>
                                    <div class="col-9">

                                        <p>Opis badania: {{$history->opis}}</p>
                                        <p>Weterynarz: {{$history->weterynarz}}</p>
                                        <p>cena: {{$history->rachunek}} zł</p>
                                        <p>data wstawienia: {{ $history->TimeCreated }}</p>

                                        </a>

                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>


                    @endforeach


                    @endsection