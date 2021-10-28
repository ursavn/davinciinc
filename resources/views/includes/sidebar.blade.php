<div class="sidebar">
    {{-- TODO: refactor --}}
    <div class="title">
        <p>PetFlier</p>
    </div>
    <nav id="nav">
        <ul class="nav__top">
            <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                <i class="fas fa-users"></i><a href="{{ route('admin.users.index') }}">Users Management</a>
            </li>
            <li class="{{ Route::is('admin.categories.index') ? 'active' : '' }}">
                <i class="fas fa-th-list"></i><a href="{{ route('admin.categories.index') }}">Categories Management</a>
            </li>
            <li class="{{ Route::is('admin.templates.index') ? 'active' : '' }}">
                <i class="fas fa-th-list"></i><a href="{{ route('admin.templates.index') }}">Templates Management</a>
            </li>
            <li class="{{ Route::is('admin.user-templates.index') ? 'active' : '' }}">
                <i class="fas fa-th-list"></i><a href="{{ route('admin.user-templates.index') }}">User Templates</a>
            </li>
        </ul>
    </nav>
</div>

@include('pages/admin/auth/reset-password')

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
            background-color: #343a40;
            position: fixed;
            height: 100%;
            font-size: 13px;
            box-shadow: inset 0px 0px 5px rgba(0,0,0,.1);
        }

        div.sidebar .title {
            height: 60px;
            border-bottom: 1px solid #4b545c;
            color: #c2c7d0;
            font-size: 30px;
            text-align: center;
            line-height: 2;
        }

        div.sidebar nav {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            padding: 0 7px;
        }

        .sidebar li {
            margin: 5px 0;
            border-radius: 3px;
        }

        .sidebar li:hover {
        }

        .sidebar li > * {
            display: inline-block;
            color: #c2c7d0;
            padding: 12px;
            text-decoration: none;
        }
        .sidebar li > a {
            padding-left: 0px;
        }

        .sidebar li:hover {
            cursor: pointer;
            background-color: rgba(255,255,255,.1);
            color: #fff;
        }

        .sidebar li.active {
            background-color: rgba(255,255,255,.9);
        }

        .sidebar li.active > * {
            color: #24292e;
        }

        ul {
            padding: 0;
            list-style-type: none;
        }

    </style>
    @push('style')
