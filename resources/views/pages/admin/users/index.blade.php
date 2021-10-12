@extends('layouts.admin.app')

@section('content')
    <div class="categories-list">
        <div class="c-header">
            <h2>Users List</h2>
        </div>
        <div class="c-content">
            <div class="text-end mb-3">
                <a href="{{ route('admin.users.create') }}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>
            <div class="table-wrapper">
                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Creator</th>
                        <th>Updater</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('admin.any-data') !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'creator',
                        name: 'creator'
                    },
                    {
                        data: 'updater',
                        name: 'updater'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
    </script>
@endpush
