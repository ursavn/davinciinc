@extends('layouts.app')

@section('content')
    <div class="home">
        <div class="home__type-select">
            <div class="home__image-button">
                <img src="https://i.kym-cdn.com/entries/icons/original/000/035/699/pepe.jpg" />
                <div class="center">迷子ペット</div>
                <div class="go">> GO</div>
            </div>
            <div class="home__image-button">
                <img
                    src="https://external-preview.redd.it/xPTu85KZxiSgka88xucW9vF5loOYdzLfgvvWWMCkVEI.jpg?auto=webp&s=6cef5f96dd4a1cb47e7b703ad674e29254e12983" />
                <div class="center">保護ペット</div>
                <div class="center">保護ペット</div>
            </div>
            <div class="home__image-button">
                <img src="https://i.kym-cdn.com/entries/icons/original/000/013/564/doge.jpg" />
                <div class="center">里親募集</div>
                <div class="center">里親募集</div>
            </div>
        </div>

        <div class="home__info">
            <div class="home__how-to">
                <h2>HOW TO USE</h2>
                <hr />
                <span>本サイトの使い方</span>
            </div>
            <p class="home__intro">
                ペットの無料ポスター・チラシデータ作成サイト「PetFlier(ペットフライヤー)」では、どなたでも無料でチラシ・ポスターを作成できます。
                作成されたデータは、すぐに印刷がしやすいように PDF 形式でダウンロードができます。
                また、現在の SNS 普及の観点から、JPEG 形式によるスマホ用画像の作成も可能です。
                皆様の大切なペットが、1 日でも早く幸せな日常を過ごせるように、当サイトをご活用いただければ幸いです。
            </p>

            <div>
                <h2> 01 作成したいチラシ・ポスターの項目を選ぶ</h2>
                <p>上記の 3 項目(迷子ペット・保護ペット・里親募集)の中から作成したい項目をご選択ください。</p>
            </div>

            <div>
                <h2> 02 テンプレートを選択する</h2>
                <p>ご希望のテンプレートをご選択ください。選択、決定後 PDF データ・JPEG データがダウンロードできます。</p>
            </div>

            <div>
                <h2> 03 必要な項目を入力する </h2>
                <p>テンプレートにはめ込み表示するため、項目(ペットの種類やお名前、特徴やご連絡先)はすべて必須項目となります。</p>
            </div>
        </div>
    </div>
@endsection
