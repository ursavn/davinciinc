@extends('layouts.app')

@section('content')
    <div class="categories-list">
        <div class="categories-list__header d-flex justify-content-between mt-3 mb-3">
            <div class="categories-list__title">
                <h2>Categories List</h2>
            </div>
            <div class="categories-list__create">
                <button type="button" class="btn btn-xs btn-success categories_list--create-btn" id="opener">
                    <i class="fa fa-plus"></i> Create
                </button>
            </div>
        </div>
        <div class="categories-list__content">
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

        <div id="dialog" title="Basic dialog">
            <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the &apos;x&apos; icon.</p>
        </div>
    </div>
@endsection

<style>
    .ui-widget-header,.ui-state-default, ui-button{
        background:crimson;
        border: 2px solid brown;
        color: white;
        font-weight: bold;
    }
</style>

@push('scripts')
    <script>


            $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
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


