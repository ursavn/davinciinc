<!doctype html>

<html lang="jp">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="login">
        <div class="login__box">
            <div class="login__title text-center mb-3"><h2>Login</h2></div>
            <div class="login__content">
                @if (count($errors) >0)
                    <ul class="login__error">
                        @foreach($errors->all() as $error)
                            <li class="text-danger"> {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (session('status'))
                    <ul class="login__error">
                        <li class="text-danger"> {{ session('status') }}</li>
                    </ul>
                @endif
                <form action="{{ route('post-login') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="login__action">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <div class="login__footer">
                        <a href="{{ route('get-register') }}">Register new account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

