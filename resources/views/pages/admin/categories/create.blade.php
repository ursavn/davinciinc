@extends('layouts.admin.app')

@section('content')
    <div class="category_create">
        <div class="c-header">
            <h2>Create Category</h2>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="c-content">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Category name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Category description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>
            <div class="category_create--footer c-actions">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection
