<div class="sidebar">
    {{-- TODO: refactor --}}
    <nav id="nav">
        <ul>
            {{-- <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i><a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li> --}}
            <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                <i class="fas fa-th-list"></i><a href="{{ route('admin.users.index') }}">Users list</a>
            </li>

            <li class="{{ Route::is('admin.categories.index') ? 'active' : '' }}">
                <i class="fas fa-th-list"></i><a href="{{ route('admin.categories.index') }}">Categories list</a>
            </li>

            <li class="{{ Route::is('admin.templates.index') ? 'active' : '' }}">
                <i class="fas fa-th-list"></i><a href="{{ route('admin.templates.index') }}">Templates list</a>
            </li>

            <li>
                <i class="fas fa-sign-out-alt"></i><a href="{{ route('admin.auth.get-logout') }}">Log out</a>
            </li>
        </ul>
    </nav>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#nav ul li').click(function(event) {
            $(this).children('a')[0].click();
        })
    });
</script>
@endpush

@push('style')
<style>
    .sidebar {
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f7f7f7;
        position: fixed;
        height: 100%;
        overflow: auto;
        font-weight: bold;
    }

    .sidebar li:hover {
        cursor: pointer;
    }

    .sidebar li>* {
        display: inline-block;
        color: #b0b0b0;
        padding: 16px;
        text-decoration: none;
    }

    .sidebar li.active {
        background-color: #e0e0e0;
        color: #3d3d3d;
    }

    .sidebar li:hover:not(.active) {
        background-color: #e0e0e0;
        color: #3d3d3d;
    }

    ul {
        padding: 0;
        list-style-type: none;
    }

</style>
@push('style')
