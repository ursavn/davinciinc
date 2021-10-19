@extends('layouts.app')

@section('content')
    <div class="select-template">
        <div class="select-template__cover">
            <img class="background" src="https://i.kym-cdn.com/entries/icons/original/000/035/699/pepe.jpg" />
            <div class="overlay">
                <div class="center-text">迷子ペット用チラシ作成</div>
            </div>
        </div>
    </div>

    <div class="select-template__template-list">
        @foreach ($templates as $template)
            <div class="select-template__image-button">
                <img src="{{ asset('storage/templates/image/' . $template->img_url) }}">
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
    </div>
@endsection
