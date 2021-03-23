@extends('common.ol')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/norm.css') }}">
@endsection

@section('main')
  <!-- ↓↓↓メインコンテンツ↓↓↓ -->
  <main id="main">
    <!-- タイトル部 -->
    <div class="title-block">
      <div class="title-block__category">{{ $article->category->name }}</div>
      <h1 class="title-block__title">{{ $article->title }}</h1>
      <div class="title-block__date">갱신날자: <time>{{ $article->created_at }}</time></div>
    </div>
    <!-- タイトル部 -->

    {{-- $article->introductionの部分はまだコーディングしてない状態 --}}

    @if (count($article->subContents) > 0)
      <!-- 本文部 -->
      <div class="content-block">
        @foreach ($article->subContents as $item)
          <section class="content-section">
            <div class="section-title-block">
              <span class="section-title-block__number">{{ $item->no }}</span>
              <h3 class="section-title-block__title">{{ $item->title }}</h3>
            </div>
            <div class="section-content-block">
              {!! $item->description !!}
            </div>
          </section>
        @endforeach

      </div>
      <!-- 本文部 -->
    @endif
  </main>
  <!-- ↑↑↑メインコンテンツ↑↑↑ -->
@endsection
