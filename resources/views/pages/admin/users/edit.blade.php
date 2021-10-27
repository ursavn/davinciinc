@extends('layouts.admin.app')

@section('content')
    <div class="user-create">
        <div class="c-header">
            @if ($isMe === true)
                <h2>Edit Profile</h2>
            @else
                <h2>Edit User</h2>
            @endif
        </div>
        <form action="{{ route('admin.users.update', $user) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="isMe" value="{{ $isMe }}">
            <div class="c-content">
                @include('includes/alert-block')
                <div class="form-group d-flex flex-column mb-0">
                    <div class="user-create__avatar">
                        @if ($user->avatar == "")
                            <img id="avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2V3ynaT18VgjH2uGddnhnQQaa_OT6nzEOtw&usqp=CAU">
                        @else
                            <img id="avatar" src="{{ asset('storage/avatar/' . $user->avatar) }}">
                        @endif
                    </div>
                    <label class="user-create__avatar-label">
                        <i class="fas fa-camera"></i>
                        <input type="file" class="form-control" name="avatar" style="display: none" onchange="readURL(this)">
                    </label>
                </div>
                <div class="form-group">
                    <label>Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" placeholder="Username">
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Role <span class="text-danger">*</span></label>
                    <select class="form-control" name="role">
                        <option value="">-----</option>
                        @foreach($roles as $key => $value)
                            <option value="{{ $key }}"
                                @if ($key === $user->role)
                                    selected
                                @endif
                            >{{ $value }}</option>
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

