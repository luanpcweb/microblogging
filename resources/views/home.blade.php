@extends('master')

@section('content')
    <main role="main" class="container">

        @if(session()->has('message'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">

            @for ($i=0; $i < count($tweets); $i++)

            <div class="col-lg-3 col-md-3">
                <div class="card espacamento">
                  <div class="card-body">

                    <p class="card-text">{{ $tweets[$i]['text'] }}</p>

                    <h5 class="card-title">{{ $tweets[$i]['username'] }}</h5>
                    <p class="card-subtitle mb-2 text-muted"><small>{{ $tweets[$i]['created_at']->format('d/m/Y H:i:s') }}</small></p>
                    <form action="/tweet/{{ $tweets[$i]['id'] }}/delete" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-default excluir"><i class="fas fa-trash-alt"></i> Excluir</button>
                    </form>
                  </div>
                </div>
            </div>

            @endfor

        </div>

    </main>
@endsection

