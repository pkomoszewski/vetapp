<!DOCTYPE html>
<html lang="pl">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vetapp</title>




  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
    rel="stylesheet">


  <link href="/css/one-page-wonder.min.css" rel="stylesheet">
  <link href="/css/one-page-wonder.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">

  <script>
    var base_url = '{{ url('/') }}';
  </script>
</head>

<body>
  <nav class="navbar-expand-lg navbar-light  ">
    <div class="container">
      <a class="navbar-brand" href="/">VettApp</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Zaloguj się</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">Zarejestruj się</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
              <a class="dropdown-item" href="{{ route('register') }}">jako właściciel pupila</a>
              <a class="dropdown-item" href="{{ route('registervet') }}">jako weterynarz</a>
            </div>
          </li>



          <li class="nav-item">
            <a class="nav-link" href="{{ route('ShowListArticles') }}">Artykuły</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Kontakt</a>
          </li>
          @endguest
          @auth


          <li class="nav-item">
            <a class="nav-link" href="{{ route('ShowListArticles') }}">Artykuły</a>
          </li>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" v-pre>
              Konto <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                Wyloguj się
              </a>
              <a class="dropdown-item" href="{{ route('profile.index',['user'=>Auth::user()->id ]) }}">Profil
                użytkownika</a>
              @if(Auth::user()->hasRole('Użytkownik'))
              <a class="dropdown-item"
                href="{{ route('calendarVisitToUser',['owner_id'=>Auth::user()->owners->id ]) }}">Moje
                wizyty</a>
              @elseif(Auth::user()->hasRole('Weterynarz'))
              <a class="dropdown-item" href="{{ route('calendarvisits',['user_id'=>Auth::user()->id ]) }}">Kalendarz
                wizyt</a>
              @endif
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>

            @endauth



        </ul>
      </div>
    </div>
  </nav>
   
        @yield('content')
   
  <footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-6">
              <h2 class="footer-heading mb-4">About</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident rerum unde possimus molestias
                dolorem fuga, illo quis fugiat!</p>
            </div>

            <div class="col-md-3">
              <h2 class="footer-heading mb-4">Navigations</h2>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <h2 class="footer-heading mb-4">Follow Us</h2>
              <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <form action="#" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control border-secondary text-white bg-transparent"
                placeholder="Search products..." aria-label="Enter Email" aria-describedby="button-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary text-white" type="button" id="button-addon2">Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row pt-5 mt-5 text-center">
        <div class="col-md-12">
          <div class="border-top pt-5">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>
                document.write(new Date().getFullYear());
              </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i>
              by <a href="https://colorlib.com" target="_blank">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>

      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->


  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



  @yield('javascript')

</body>

</html>