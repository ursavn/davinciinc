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

    <div class="full-width full-width--padding">
        <div class="select-template__template-list">
            @foreach ($templates as $template)
                <div class="select-template__image-button">
                    <div class="template-image" style='background-image: url("https://i.kym-cdn.com/entries/icons/original/000/013/564/doge.jpg")'></div>
                    <div class="overlay">
                        <button class="select-button">
                            <a href="{{ route('show-template', 1) }}">
                                このテンプレートで作成する
                            </a>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
