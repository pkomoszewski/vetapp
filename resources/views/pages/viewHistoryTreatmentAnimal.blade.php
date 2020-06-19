@extends('main')

@section('content')
<div class="container " style="background-color: #eff2f8;" >
    <div class="row d-flex justify-content-center">
        @if ($histories->isEmpty())
        <div class="p-2">
            <center>
            <h6 class="m-2">Brak danych o leczeniu</h6>
        </center></div>

        @else
        <div class="col-8 mb-2 ">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h6 class="m-2">koszt leczenia {{ $totalbill }} zł</h6>

                    @foreach ($histories as $history)
                    <div class="row">
                        <div class="container mt-5">
                            <div class="card p-2">

                                <div class="row">
                                    <div class="col-3">

                                    </div>
                                    <div class="col-9">

                                        <p> <strong> Opis badania:</strong> {{$history->opis}}</p>
                                        <p><strong> Weterynarz:</strong> {{$history->weterynarz}}</p>
                                        <p><strong> cena:</strong>  {{$history->rachunek}} zł</p>
                                        <p><strong> data wstawienia:</strong> {{ $history->TimeCreated }}</p>

                                        </a>

                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>


                    @endforeach
                    @endif
                </div>

            </div>    </div>

        </div>
    </div>
                    @endsection