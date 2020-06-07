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
          <li><a href="">Kontakt</a></li>
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