<!doctype html>

<html lang="jp">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
<div class="user-register">
    <div class="user-register__box">
        <div class="user-register__title text-center mb-4"><h2>Register</h2></div>
        <div class="user-register__content">
            <form action="{{ route('post-register') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group d-flex flex-column align-items-center mb-0">
                    <div class="user-register__avatar">
                        <img id="avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2V3ynaT18VgjH2uGddnhnQQaa_OT6nzEOtw&usqp=CAU">
                    </div>
                    <label class="user-register__avatar-label">
                        <i class="fas fa-camera"></i>
                        <input type="file" class="form-control" name="avatar" style="display: none" onchange="readURL(this)">
                    </label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="user-register__action pt-2">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function () {
                $('#avatar').attr('src', reader.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

