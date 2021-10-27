@extends('layouts.admin.app')

@section('content')
    <div class="category_create">
        <div class="c-header">
            <h2>Edit Template</h2>
        </div>
        <form action="{{ route('admin.templates.update', $template->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="old_file" value="{{ $template->url }}">
            <div class="c-content">
                <div class="form-group">
                    <label for="exampleInputEmail1">Template name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $template->name }}" placeholder="Template name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Category <span class="text-danger">*</span></label>
                    <select class="form-control" name="category_id">
                        <option value="">-----</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if ($template->category_id === $category->id)
                                    selected
                                @endif
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Template image</label>
                    <input type="file" class="form-control-file" name="img_url">
                    @if ($errors->has('img_url'))
                        <span class="text-danger">{{ $errors->first('img_url') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Template html</label>
                    <input type="file" class="form-control-file" name="html_url" accept=".html">
                    @if ($errors->has('html_url'))
                        <span class="text-danger">{{ $errors->first('html_url') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Template description</label>
                    <textarea class="form-control" name="description" rows="3">{{ $template->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="category_create--footer c-actions">
                    <a href="{{ route('admin.templates.index') }}" class="btn btn-dark">Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
