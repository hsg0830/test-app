@extends('common.ol')


@section('css')
  <link rel="stylesheet" href="{{ asset('css/norm.css') }}" />
@endsection

@section('main')
  <!-- ↓↓↓メインコンテンツ↓↓↓ -->
  <main id="main">
    <h1 class="norm-category-title">
      언어규범과 관련한 각종 해설
    </h1>
    <div class="list-container">
      <div class="list-container__selector">
        <ul>
          <li id="tabs-menu-a">전체</li>
          <li id="tabs-menu-b">맞춤법</li>
          <li id="tabs-menu-c">발음</li>
          <li id="tabs-menu-d">띄여쓰기</li>
          <li id="tabs-menu-e">기타</li>
        </ul>
      </div>
      <div id="tabs-content-a" class="list-container__wrapper">
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_memo_thum.png" alt="" />
              <p class="title color">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_memo_thum.png" alt="" />
              <p class="title color">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_memo_thum.png" alt="" />
              <p class="title color">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_memo_thum.png" alt="" />
              <p class="title color">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_memo_thum.png" alt="" />
              <p class="title color">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div id="tabs-content-b" class="list-container__wrapper">
        맞춤법
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_black-board_thum.png" alt="" />
              <p class="title">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div id="tabs-content-c" class="list-container__wrapper">
        발음
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_black-board_thum.png" alt="" />
              <p class="title">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div id="tabs-content-d" class="list-container__wrapper">
        띄여쓰기
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_black-board_thum.png" alt="" />
              <p class="title">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div id="tabs-content-e" class="list-container__wrapper">
        기타
        <div class="list-item">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_memo_thum.png" alt="" />
              <p class="title">맞춤법이란 무엇인가?</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                조선말의 맞춤법에 대하여 알기 전에 맞춤법이란 무엇인가를
                확인해보자. 세계에는 수많은 문자(文字)가 존재한다. 우리
                생활에 가까운 문자만 ...
              </p>
              <div class="info">
                <p class="date">2021-02-04</p>
                <p class="category">맞춤법</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </main>
  <!-- ↑↑↑メインコンテンツ↑↑↑ -->
@endsection

@section('js')
  <!-- 規範関連ページ用 -->
  <script src="{{ asset('js/norm.js') }}"></script>
@endsection
