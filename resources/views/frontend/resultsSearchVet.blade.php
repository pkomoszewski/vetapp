
@extends('main') 

@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
<div class="container m-5">
                    
    @foreach ($Vets->vets as $vet)
        
    {{$vet->imie}}
    {{$vet->Nazwisko}}
    @endforeach
</div>
@endsection
