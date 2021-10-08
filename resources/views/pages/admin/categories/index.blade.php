@extends('layouts.admin.app')

@section('content')
    <div class="categories-list">
        <div class="categories-list__header c-header">
            <h2>Categories List</h2>
        </div>
        <div class="categories-list__content c-content">
            <div class="categories-list__create text-end mb-3">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-success alert-block">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif

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

        <!-- Modal -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>

</style>

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

