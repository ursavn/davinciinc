<!doctype html>

<html lang="jp">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >

    <title>PetFlier</title>
</head>

<body class="c-app">
    @include('includes.header')
    @include('includes.partials.logo')
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    @include('includes.footer')
</body>

</html>
