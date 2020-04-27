
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
                            <p>{{ $vet->imie }}</p>
                            <p>{{ $vet->Nazwisko }}</p>
                           

                       
                            @auth
                            <div class="col-6 ml-2">
                                @if($vet->isLiked())
                                <a href="{{ route('unlike',['like_id'=>$vet->id,'type'=>'App\Vet']) }}" class="btn btn-primary btn-xs top-buffer">Unlike this object</a>
                                @else
                                <a href="{{ route('like',['like_id'=>$vet->id,'type'=>'App\Vet']) }}" class="btn btn-primary btn-xs top-buffer">Like this object</a>
                                @endif
                            @endauth
                        </div>

<div class="row">

    <div class="col-6">
        @foreach( $vet->comments as $comment ) <!-- Lecture 22 -->
        <div class="media">
        {{$comment->user->email}}
            <div class="media-body">
               {{ $comment->content /* Lecture 22 */ }}
            </div>
        </div>
        <hr>
    @endforeach

    </div>
</div>

                    </div>

                     
        </div>
    </div>
</div>
@endsection
