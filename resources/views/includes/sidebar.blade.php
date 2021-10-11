<div class="sidebar">
    {{-- TODO: refactor --}}
    <nav id="nav">
        <ul class="nav__top">
            <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                <i class="fas fa-th-list"></i><a href="{{ route('admin.users.index') }}">Users list</a>
            </li>
            <li>
                <i class="fas fa-th-list"></i><a href="{{ route('admin.users.index') }}">Temp 1</a>
            </li>
            <li>
                <i class="fas fa-th-list"></i><a href="{{ route('admin.users.index') }}">Temp 2</a>
            </li>
        </ul>
        <ul class="nav__bottom">
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
    div.sidebar {
        margin: 0;
        padding: 0;
        width: 250px;
        background-color: #f7f7f7;
        position: fixed;
        height: 100%;
        overflow: auto;
        font-weight: bold;
    }

    div.sidebar nav {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
    
    div.sidebar nav ul.nav__bottom {
        margin: 0;
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
    }
    .sidebar li.active > * {
        color: #3a3a3a;
    }
    
    .sidebar li:hover:not(.active) {
        background-color: #e0e0e0;
        color: #b7b7b7;
    }

    ul {
        padding: 0;
        list-style-type: none;
    }

</style>
@push('style')
