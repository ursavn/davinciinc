<header class="header">
    <div class="dropdown">
        <button class="avatar" type="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if (Auth::user()->avatar)
                <img src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}">
            @else
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2V3ynaT18VgjH2uGddnhnQQaa_OT6nzEOtw&usqp=CAU">
            @endif
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdown">
            <a href="{{ route('admin.users.edit', Auth::user()->id) }}" class="dropdown-item">
                <i class="fas fa-user-circle mr-1"></i>
                Edit profile
            </a>
            <button class="dropdown-item" type="button" id="resetPassBtn" data-toggle="modal" data-target="#resetPasswordModal">
                <i class="fas fa-lock mr-1"></i>
                Reset password
            </button>
            <a href="{{ route('admin.auth.get-logout') }}" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-1"></i>
                Log out
            </a>
        </div>
    </div>
</header>
