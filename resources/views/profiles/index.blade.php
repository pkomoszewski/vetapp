@extends('main')

@section('content')
@csrf
<div class="container">
    <div class="row">
      @csrf

      <div class="col-md-6 img text-center">
        <img src="/storage/{{ $user->profile->image }}"  alt="" class="img-thumbnail">
      </div>
      <div class="col-md-6 details">
        <blockquote>
          <h5>{{ $user->name }}</h5>
          <small><cite title="Source Title">{{ $user->profile->opis }}<i class="icon-map-marker"></i></cite></small>
        </blockquote>
        <p>
          {{$user->email}} <br>
          www.bootsnipp.com <br>
         Data założenia konta: {{$user->created_at->format('d-m-Y')}}
        </p>
         Typ konta : @foreach ($user->roles as $role)
             {{$role->typ}}
         @endforeach
      

        <a href='/profile/{{Auth::user()->id}}/edit'> Edycja profilu </a>
      </div>
    </div>
    
  

    <div class="col-12 bg shadow-sm mt-2">
        <p>Twoje zamówienia</p> 
    

        @foreach($user->concerts as $concert)
        <div class="row pt-2">
<div class="col-6 ">
<h4>
    
    {{$concert->tytul}}

</h3>
               
               <p> cena: {{$concert->cena}}</p>

            </div>

            
        </div>

        @endforeach

    </div>
  
  </div>
</div>
@endsection
