
@extends('main') 

@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
<div class="container m-5">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://lorempixel.com/200/200/people/?x=<?= mt_rand(1, 9999999) ?>" alt="" class="img-circle img-responsive">
                        </div>
                        <div class="col-xs-12 col-sm-9 ">
                            <h2>{{ $vet->name }}</h2>
                            <p>  {{$vet->email}}</p>

                       

                        </div>
                    </div>

                     
        </div>
    </div>
</div>
@endsection
