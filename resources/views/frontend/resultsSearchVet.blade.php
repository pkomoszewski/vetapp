
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
        <div class="card">

            <div class="row">
<div class="col-3">
   
        @if ($vet->photos->isEmpty())
        @else
        <img src="{{$vet->photos->first()->path}}" alt="" class="img-circle img-responsive" with='100px' height='100px'>
        @endif
    </div>
<div class="col-9">
 <a href="{{ route('sitevet',['id'=>$vet->id]) }}">
    <p> {{$vet->imie}} {{$vet->nazwisko}}</p> 
  </a> 
  <p>{{$vet->adres}}</p> 


            
</div>
            </div>
            

            <div class="row">
                <div class="col-6 ml-2">
                   komentarze</div>
                </div>

                </div>
                 </div>

            </div>
        </div>
   
    @endforeach

</div>
@endsection
