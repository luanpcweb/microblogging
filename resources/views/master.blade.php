<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Microblogging</title>

        <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css")}}">

        <style type="text/css">
            .espacamento { margin-bottom: 30px; }

            .excluir { color: red;  }
            .excluir:hover { color: #ae2424; }
            .espacamento-botao-tweet { margin-right: 20px; }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
          <a class="navbar-brand" href="/">Microblogging</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
            </ul>
            <a href="/tweet" class="btn btn-success my-2 my-sm-0 espacamento-botao-tweet"><i class="fas fa-plus-circle"></i> Tweet</a>

          </div>
        </nav>

        @yield('content')

        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


        <script src="https://kit.fontawesome.com/3e5fd78bda.js" crossorigin="anonymous"></script>
    </body>
</html>
