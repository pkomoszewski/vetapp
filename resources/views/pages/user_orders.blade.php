@extends('main')
@section('content')
<section>

<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<section class="jumbotron text-center">
  <h1>Twoje zamówienie</h1>
  <p class="text-muted">Miłej zabawy</p>

</section>
<section class="pricing py-5 ">
  <div class="container">

    @csrf


    <div class="row p-5">
      @csrf
    @if (count($orders)==0)
        <div>Nic jeszcze nie zamówiłeś</div>
    @else
    @foreach($orders as $data)
  
      
    <div class="col-lg-4">
     
          
      <div class="card mb-4">
        <img class="card-img-top" src="https://source.unsplash.com/collection/190727/1400x700" alt="Card image">

        <div class="card-body">
          <h5 class="card-title text-muted text-uppercase text-center">{{$data->tytul}}</h5>
          <h6 class="card-price text-center">{{DateTime::createFromFormat('Y-m-d',$data->data_koncertu)->format('d-m-Y')}}</h6>
        <h6 class="card-text text-center">cena: {{$data->cena}} </h6>
        <h6 class="card-text text-center"> {{$data->miasto}}</h6>
        
          <hr>
        <p>  {{$data->opis}}</p>
          
            
         
        </div>
        <div class="card-footer">
          <small class="text-muted">dodano: {{$data->created_at->format('d-m-Y')}}</small>
      </div>
      </div>
    </div>
 

  
    @endforeach
    @endif
          
    
    </div>
  </div>
</section>
    
@endsection