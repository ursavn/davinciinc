@extends('layouts.admin.app')

@section('content')
    <div class="user-templates-list">
        <div class="c-header">
            <h2>User Template Detail</h2>
        </div>
        <div class="c-content">
            @foreach($content as $key => $val)
                <div class="user-template-list__content">
                    <div><span>{!! $val->label !!}</span></div>
                    <div>
                        @if($val->type === 'file')
                            <img src="{{ $val->value }}" width="350px">
                        @else
                            <span>{!! $val->value !!}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="c-actions">
            <a href="{{ route('admin.user-templates.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .user-template-list__content {
            padding: 10px 0;
            border-bottom: 1px dashed #a19c9c;
        }
        .user-template-list__content div:first-child {
            font-weight: bold;
        }
    </style>
@endpush
