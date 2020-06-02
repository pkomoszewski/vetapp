<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vetapp</title>

    <!-- Scripts -->


    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
        rel="stylesheet">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


    <script>
        var base_url = '{{ url('/') }}';
    </script>

</head>

<body>
    <div class="d-flex" id="wrapper">


        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white bg-dark">Panel administratora </div>
            <div class="list-group list-group-flush">
                <a href="{{route('indexPAS')}}" class="list-group-item list-group-item-action bg-light">Właściclele</a>
                <a href="{{route('allVet')}}" class="list-group-item list-group-item-action bg-light">Weterynarze</a>
                <a href="indexVisits" class="list-group-item list-group-item-action bg-light">Klinika</a>
                <a href="{{route('allArticle')}}" class="list-group-item list-group-item-action bg-light">Artykuły</a>
                <a href="" class="list-group-item list-group-item-action bg-light">Uprawnienia</a>
                <a href="{{route('indexVisits')}}" class="list-group-item list-group-item-action bg-light">Wizyty</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Historie rezerwacji</a>
                <a href="{{route("staticSite")}}" class="list-group-item list-group-item-action bg-light">Statystki</a>
            </div>
        </div>
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Zwiń menu</button>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>





            <div class="container-fluid">
                @yield('content')
            </div>

        </div>


    </div>



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



</body>

</html>