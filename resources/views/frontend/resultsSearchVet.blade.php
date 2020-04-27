
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
zdjecie</div>
<div class="col-9">
 <a href="{{ route('sitevet',['id'=>$vet->id]) }}">
    <p> {{$vet->imie}}</p> 
    <p> {{$vet->Nazwisko}}</p> 
  </a> 

 

    <p>rating</p>

            
</div>
            </div>
            

            <div class="row">
                <div class="col-6 ml-2">
                   komentarze</div>
                </div>
@auth
                <div class="col-6 ml-2">
                    @if($vet->isLiked())
                    <a href="{{ route('unlike',['like_id'=>$vet->id,'type'=>'App\Vet']) }}" class="btn btn-primary btn-xs top-buffer">Unlike this object</a>
                    @else
                    <a href="{{ route('like',['like_id'=>$vet->id,'type'=>'App\Vet']) }}" class="btn btn-primary btn-xs top-buffer">Like this object</a>
                    @endif
@endauth
                </div>
                 </div>

            </div>
        </div>
   
    @endforeach

</div>
@endsection
