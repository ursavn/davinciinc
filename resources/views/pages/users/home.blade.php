@extends('layouts.app')

@section('content')
    <div class="home full-width full-width--padding">
        <div class="home__type-select full-width">
            <div class="home__image-button">
                <div class="type-image"></div>
                <div class="overlay">
                    <div class="type-content center">迷子ペット</div>
                    <a href="{{ route('select-template') }}" class="type-content bottom">> GO CREATE</a>
                </div>
            </div>
            <div class="home__image-button">
                <div class="type-image"></div>
                <div class="overlay">
                    <div class="type-content center">保護ペット</div>
                    <a href="{{ route('select-template') }}" class="type-content bottom">> GO CREATE</a>
                </div>
            </div>
            <div class="home__image-button">
                <div class="type-image"></div>
                <div class="overlay">
                    <div class="type-content center">里親募集</div>
                    <a href="{{ route('select-template') }}" class="type-content bottom">> GO CREATE</a>
                </div>
            </div>
        </div>

        <div class="home__info">
            <div class="home__how-to">
                <h2>HOW TO USE</h2>
                <hr />
                <span>本サイトの使い方</span>
            </div>
            <p class="home__intro">ペットの無料ポスター・チラシデータ作成サイト「PetFlier(ペットフライヤー)」では、どなたでも無料でチラシ・ポスターを作成できます。
                作成されたデータは、すぐに印刷がしやすいように PDF 形式でダウンロードができます。
                また、現在の SNS 普及の観点から、JPEG 形式によるスマホ用画像の作成も可能です。
                皆様の大切なペットが、1 日でも早く幸せな日常を過ごせるように、当サイトをご活用いただければ幸いです。
            </p>

            <div class="home__step">
                <div class="title">
                    <h3><span>01</span>作成したいチラシ・ポスターの項目を選ぶ</h3>
                </div>
                <p>上記の 3 項目(迷子ペット・保護ペット・里親募集)の中から作成したい項目をご選択ください。</p>
            </div>

            <div class="home__step">
                <div class="title">
                    <h3><span>02</span>テンプレートを選択する</h3>
                </div>
                <p>ご希望のテンプレートをご選択ください。選択、決定後 PDF データ・JPEG データがダウンロードできます。</p>
            </div>

            <div class="home__step">
                <div class="title">
                    <h3><span>03</span>必要な項目を入力する</h3>
                </div>
                <p>テンプレートにはめ込み表示するため、項目(ペットの種類やお名前、特徴やご連絡先)はすべて必須項目となります。</p>
            </div>
        </div>
    </div>
@endsection
