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
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown">Zarejestruj się</a>
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
          </li>
          @endauth



        </ul>
      </div>
    </div>
  </nav>
   
        @yield('content')
   
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; kotarbinski 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->


  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script>
    $("#menu-toggle").click(function (e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
});

$('#delete').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget) 
var delete_id = button.data('deleteid') 
var modal = $(this)
modal.find('.modal-body #delete_id').val(delete_id);
})
  </script>


  @yield('javascript')

</body>

</html>