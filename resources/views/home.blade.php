@extends('master')

@section('content')
    <main role="main" class="container">

        <div class="row">

            @for ($i=0; $i < count($tweets); $i++)

            <div class="col-lg-3 col-md-3">
                <div class="card espacamento">
                  <div class="card-body">

                    <p class="card-text">{{ $tweets[$i]['text'] }}</p>

                    <h5 class="card-title">{{ $tweets[$i]['username'] }}</h5>
                    <p class="card-subtitle mb-2 text-muted"><small>{{ $tweets[$i]['created_at']->format('d/m/Y H:i:s') }}</small></p>
                    <a href="/tweet/{{ $tweets[$i]['id'] }}/delete" class="card-link excluir"><i class="fas fa-trash-alt"></i> Excluir</a>
                  </div>
                </div>
            </div>

            @endfor

        </div>

    </main>
@endsection

