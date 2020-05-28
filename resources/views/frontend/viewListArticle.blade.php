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
                            <div class="card mb-4">

                                <div class="card-body">
                                    <h2 class="card-title">{{$article->title}}</h2>
                                    <p class="card-text">
                                        {{\Illuminate\Support\Str::words($article->content, 50,'....')}}
                                    </p>
                                    <a href="{{ route('showArticle',['id'=>$article->id]) }}"
                                        class="btn btn-dark">Czytaj
                                        dalej</a>
                                </div>
                                <div class="card-footer text-muted">
                                    opublikowano: {{$article->TimeCreated}}
                                </div>
                            </div>
                        </div>











                    </div>
                    @endforeach
                    @endsection