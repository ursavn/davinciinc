@extends('layouts.admin.app')

@section('content')
    <div class="categories-list">
        <div class="c-header">
            <h2>Categories List</h2>
        </div>
        <div class="c-content">
            <div class="text-end mb-3">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>

            @include('includes/alert-block')

            <div class="categories-list__table">
                <table class="table table-bordered" id="categories-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Created By</th>
                        <th>Updated By</th>
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
            $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('admin.categories.any-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'creator', name: 'creator' },
                    { data: 'updater', name: 'updater' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush


