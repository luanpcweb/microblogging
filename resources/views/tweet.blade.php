@extends('master')

@section('content')
    <main role="main" class="container">

        @if($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
        @endif

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form method="post" action="/tweet" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="@username" >
                    </div>

                    <div class="form-group">
                        <label for="tweet">Tweet</label>
                        <textarea class="form-control" id="tweet" name="tweet" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </form>
            </div>
        </div>


    </main>
@endsection

