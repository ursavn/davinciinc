@extends('layouts.admin.app')

@section('content')
    <div class="user-templates-list">
        <div class="c-header">
            <h2>User Templates List</h2>
        </div>
        @include('includes/alert-block')
        <div class="c-content">
            <div class="user-templates-list__table">
                <table class="table table-bordered" id="templates-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Template Name</th>
                        <th>Template Url</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

<style>

</style>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#templates-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('admin.user-templates.any-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'template_name', name: 'template_name' },
                    { data: 'template_url', name: 'template_url' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush


