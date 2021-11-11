@extends('layouts.admin.app')

@section('content')
    <div class="category_create">
        <div class="c-header">
            <h2>Edit Category</h2>
        </div>
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="c-content">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" placeholder="Category name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Template image</label>
                    <div class="template-img">
                        @if ($category->img_url)
                            <img src="{{ asset('storage/categories/' . $category->img_url) }}" width="300px" class="mb-2">
                        @endif
                    </div>
                    <input type="file" class="form-control-file" name="img_url" onchange="readURL(this)" accept=".jpg,.png,.jpeg">
                    @if ($errors->has('img_url'))
                        <span class="text-danger">{{ $errors->first('img_url') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Category description</label>
                    <textarea class="form-control" name="description" rows="3">{{ $category->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="category_create--footer c-actions">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-dark">Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('.template-img').html('<img src="'+ reader.result +'" width="300px" class="mb-2" />');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
