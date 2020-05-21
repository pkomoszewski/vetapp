@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach ($results as $article)
                    <div class="row">
                        <div class="container mt-5">
                            <div class="card">

                                <div class="row">
                                    <div class="col-3">

                                        @if ($article->photos->isEmpty())
                                        @else
                                        <img src="{{$article->photos->first()->path}}" alt=""
                                            class="img-circle img-responsive" with='100px' height='100px'>
                                        @endif
                                    </div>
                                    <div class="col-9">


                                        <a href="{{ route('showArticle',['id'=>$article->id]) }}">
                                            <h3>{{$article->title}}</h3>
                                        </a>
                                        {{\Illuminate\Support\Str::words($article->content, 50,'....')}}
                                    </div>
                                </div>




                            </div>
                        </div>

                    </div>


                    @endforeach


                    @endsection