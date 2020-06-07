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
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">

  <script>
    var base_url = '{{ url('/') }}';
  </script>
</head>

<body>
  <header id="header">
    <div class="container d-flex h-100 justify-content-center align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="/">Vetapp</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu  d-lg-block">
        <ul>
          @guest
          <li class="active"><a href="/">Home</a></li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown">Zarejestruj się</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
              <a class="dropdown-item" href="{{ route('register') }}">jako właściciel pupila</a>
              <a class="dropdown-item" href="{{ route('registervet') }}">jako weterynarz</a>
            </div>
          </li>
          <li><a href="{{ route('ShowListArticles') }}">Artykuły</a></li>
          <li><a href="{{route('Contact')}}">Kontakt</a></li>
          <li><a href="#faq">F.A.Q</a></li>

          <li class="get-started"><a href="{{ route('login') }}">Zaloguj się</a></li>


          @endguest
          @auth
          <li><a href="{{ route('ShowListArticles') }}">Artykuły</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown">Konto</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
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
            </div>
          </li>

          <li><a href="">Kontakt</a></li>
          <li class="get-started"> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Wyloguj się</a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          @endauth
        </ul>

      </nav>

    </div>
  </header>
   
        @yield('content')
   
  <footer id="footer">

    <div class="footer-newsletter" data-aos="fade-up">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Dołącz do newslettera</h4>
            <p>Chcesz być na bieżąco z nowościami, dołącz do Newslettera!</p>
            <form action="{{route('addNewsletter')}}" method="post">
              @csrf
              <input type="email" name="email"><input type="submit" value="Subskrybuj">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact" data-aos="fade-up">
            <h3>Vetapp</h3>
            <p>
              <br>
              Warszawa al.Jerozomiskie 54<br>
              Polska <br><br>
              <strong>Telefon:</strong> 534115615<br>
              <strong>Email:</strong> pkomoszewski@wp.pl<br>
            </p>
          </div>





          <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="300">
            <h4>Social Media</h4>

            <div>
              <a href="#" class="twitter"> <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i></a>
              <a href="#" class="facebook"> <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i></a>
              <a href="#" class="printest"> <i class="fab fa-pinterest fa-lg white-text fa-2x"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Vetapp</span></strong>
      </div>
      <div class="credits">

        Opracowane przez Paweł KOMOSZEWSKI <a href="/">Vetapp</a>
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