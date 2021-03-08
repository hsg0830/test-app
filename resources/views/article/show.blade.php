@extends('common.ol')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/norm.css') }}" />
@endsection

@section('main')
  <!-- ↓↓↓メインコンテンツ↓↓↓ -->
  <main id="main">
    <!-- タイトル部 -->
    <div class="title-block">
      <!-- <img src="../../img/bg_black-board_thum.png" alt="" /> -->
      <div class="title-block__category">{{ $article->category->name }}</div>
      <h1 class="title-block__title">{{ $article->title }}</h1>
      <div class="title-block__date">갱신날자: <time>{{ $article->created_at }}</time></div>
    </div>
    <!-- タイトル部 -->

    <!-- 本文部 -->
    <div class="content-block">
      {!! $article->description !!}
    </div>
    <!-- 本文部 -->
  </main>
  <!-- ↑↑↑メインコンテンツ↑↑↑ -->
@endsection

@section('js')
  <!-- ツールチップ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.0.5/js/jquery.tooltipster.js"></script>
  <!-- 規範関連ページ用 -->
  <script src="{{ asset('js/norm.js') }}"></script>
@endsection
