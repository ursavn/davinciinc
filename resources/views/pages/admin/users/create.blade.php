@extends('layouts.admin.app')

@section('content')
    <div class="user-create">
        <div class="c-header">
            <h2>Create User</h2>
        </div>
        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="c-content">
                <div class="form-group d-flex flex-column mb-0">
                    <div class="user-create__avatar">
                        <img id="avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2V3ynaT18VgjH2uGddnhnQQaa_OT6nzEOtw&usqp=CAU">
                    </div>
                    <label class="user-create__avatar-label">
                        <i class="fas fa-camera"></i>
                        <input type="file" class="form-control" name="avatar" style="display: none" onchange="readURL(this)">
                    </label>
                </div>
                <div class="form-group">
                    <label>Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                    @if ($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Role <span class="text-danger">*</span></label>
                    <select class="form-control" name="role">
                        <option value="">-----</option>
                        @foreach($roles as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                <div class="c-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-dark">Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('style')
    <style>
        div.user-create__avatar {
            width: 110px;
            height: 110px;
            background: #eeee;
            border: 2px solid #605858;
            border-radius: 50%;
        }
        div.user-create__avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        label.user-create__avatar-label {
            position: relative;
            top: -38px;
            left: 83px;
            width: 30px;
            height: 30px;
            background: #605858;
            border-radius: 50%;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        label.user-create__avatar-label:hover {
            background: #8c8686;
        }
    </style>
@endpush

@push('scripts')
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
@endpush

