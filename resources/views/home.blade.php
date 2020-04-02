<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Microblogging</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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
            <form class="form-inline mt-2 mt-md-0">
              <input class="form-control mr-sm-2" type="text" placeholder="#hashtag" aria-label="Pesquisar">
              <button class="btn btn-info my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Pesquisar</button>
            </form>
          </div>
        </nav>

        <main role="main" class="container">

            <div class="row">

                @for ($i=0; $i < count($tweets); $i++)

                <div class="col-lg-3 col-md-3">
                    <div class="card espacamento">
                      <div class="card-body">

                        <p class="card-text">{{ $tweets[$i]['text'] }}</p>

                        <h5 class="card-title"><?php echo '@'; ?>{{ $tweets[$i]['username'] }}</h5>
                        <p class="card-subtitle mb-2 text-muted"><small>{{ $tweets[$i]['created_at']->format('d/m/Y H:i:s') }}</small></p>
                        <a href="/tweet/{{ $tweets[$i]['id'] }}/delete" class="card-link excluir"><i class="fas fa-trash-alt"></i> Excluir</a>
                      </div>
                    </div>
                </div>

                @endfor

            </div>


        </main>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script src="https://kit.fontawesome.com/3e5fd78bda.js" crossorigin="anonymous"></script>
    </body>
</html>
