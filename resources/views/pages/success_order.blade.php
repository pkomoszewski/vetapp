@extends('main')
@section('content')

<section class="jumbotron text-center">
    <div class="conatainer">
        <h1>Zamówione</h1>

        <p class="lead text-muted">Dziekujemy za wybór. Zrobimy wszystko żebyś był zadowolony</p>
        <p><a class="btn btn-primary my-2" href="/showorder/{{ Auth::user()->id }}">Twoje zamówienia</a> </p>                             
        
      </div>
      
    </div>
    
</section>

@endsection