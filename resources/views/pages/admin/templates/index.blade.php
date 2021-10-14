@extends('layouts.admin.app')

@section('content')
    <div class="templates-list">
        <div class="c-header">
            <h2>Templates List</h2>
        </div>
        <div class="c-content">
            <div class="text-end mb-3">
                <a href="{{ route('admin.templates.create') }}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>

            @include('includes/alert-block')

            <div class="templates-list__table">
                <table class="table table-bordered" id="templates-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Description</th>
                        <th>Category</th>
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

<style>
    .url-action a:last-child {
        font-size: 14px;
    }
</style>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#templates-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('admin.templates.any-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'url', name: 'url' },
                    { data: 'description', name: 'description' },
                    { data: 'category', name: 'category' },
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


