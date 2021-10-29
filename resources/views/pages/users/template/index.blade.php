@extends('layouts.app')

@section('content')
    <div class="select-template full-width">
        <div class="select-template__cover">
            <div class="template-image"></div>
            <div class="overlay">
                <div class="center-text">迷子ペット用チラシ作成</div>
            </div>
        </div>
    </div>

    <div class="select-template__template-list full-width full-width--padding">
        @foreach ($templates as $template)
            <div class="select-template__image-button">
                <div class="template-image" style='background-image: url("{{ asset('storage/templates/image/' . $template->img_url) }}")'></div>
                <div class="overlay">
                    <button class="select-button">
                        <a href="{{ route('show-template', $template->id) }}">
                            このテンプレートで作成する
                        </a>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mb-5">
        @if ($templates->lastPage() > 1)
        {{ $templates->render('includes.pagination') }}
        @endif
    </div>
@endsection
