<!doctype html>

<html lang="jp">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <title>PetFlier</title>
</head>

<body class="c-app">
    <div class="c-wrapper">
        @include('includes.header')
        <div class="c-body">
            <main class="c-main">
                <div class="container-xl">
                    @yield('content')
                </div>
            </main>
        </div>
        @include('includes.footer')
    </div>
</body>

</html>
