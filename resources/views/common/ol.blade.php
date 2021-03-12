<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>얼 -우리 말 배움터-</title>

  <!-- 각종 서체 -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <!-- Namun -->
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet" />
  <!-- Noto -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&display=swap"
    rel="stylesheet" />
  <!-- Sunflower -->
  <link href="https://fonts.googleapis.com/css2?family=Sunflower:wght@300;500;700&display=swap" rel="stylesheet" />
  <!-- Jua -->
  <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet" />
  <!-- Dokdo -->
  <link href="https://fonts.googleapis.com/css2?family=Dokdo&display=swap" rel="stylesheet" />
  <!-- Poor -->
  <link href="https://fonts.googleapis.com/css2?family=Poor+Story&display=swap" rel="stylesheet" />
  <!-- Songmyong -->
  <link href="https://fonts.googleapis.com/css2?family=Song+Myung&display=swap" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/a57480febd.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{ asset('css/destyle.css') }}" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>

<body>
  @include('common.header')
  @include('common.breadcrumb')

  <!-- ↓↓↓.wrapper：メイン＋サイド↓↓↓ -->
  <div class="wrapper">
    @yield('main')

    @include('common.side')

  </div>
  <!-- ↑↑↑.wrapper：メイン＋サイド↑↑↑ -->

  <!-- トップに戻るボタン -->
  <a href="#" class="back-to-top">▲</a>

  @include('common.footer')

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <!-- 共通 -->
  <script src="{{ asset('js/main.js') }}"></script>

  @yield('js')
</body>

@env('local')

@include('test.route_list')

@endenv

</html>
