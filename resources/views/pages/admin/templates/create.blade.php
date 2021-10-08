@extends('layouts.admin.app')

@section('content')
    <div class="category_create">
        <div class="c-header">
            <h2>Create Template</h2>
        </div>
        <form action="{{ route('admin.templates.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="c-content">
                <div class="form-group">
                    <label>Template name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Template name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Category <span class="text-danger">*</span></label>
                    <select class="form-control" name="category_id">
                        <option value="">-----</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Template <span class="text-danger">*</span></label>
                    <input type="file" class="form-control-file" name="file" accept=".html">
                    @if ($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Template description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>
            <div class="category_create--footer c-actions">
                <a href="{{ route('admin.templates.index') }}" class="btn btn-dark">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection
