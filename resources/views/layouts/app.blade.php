<!doctype html>

<html lang="jp">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
{{--    <link href="{{ asset('styles/app.scss') }}" rel="stylesheet" type="text/css" >--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/bootstrap-datetimepicker.css">


    <title>PetFlier</title>
</head>

<body class="c-app">
    <div class="c-wrapper">
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
    </div>

    <script src="assets/js/libs/moment.min.js"></script>
    <script src="assets/js/libs/bootstrap-datetimepicker.min.js"></script>
</body>

</html>
