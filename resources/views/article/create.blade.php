@extends('common.ol')

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
@endsection

@section('main')
  <div id="app" class="container">
    <div class="row">
      <div id="input-area" class="col-6 bg-info">
        <h1>原稿を入力</h1>
        <form id="form">
          <button @click="combineDraft" class="btn btn-secondary mb-3">投稿内容をプレビュー</button>
          <div class="form-group mb-3">
            <label class="form-label">ページのタイトル：</label>
            <input type="text" class="form-control" v-model="articleTitle">
          </div>
          <div class="content-block bg-warning mb-3 p-3">
            <input type="text" class="form-control" id="title0" class="d-block mb-3">
            <textarea class="form-control" id="content0" class="d-block"></textarea>
          </div>
        </form>
        <button @click="addFormBlock" class="btn btn-primary">入力フォームを追加</button>
        <button @click="removeFormBlock" class="btn btn-danger">最後のフォームブロックを削除</button>
      </div>

      <div class="col-6 bg-success">
        <h1>プレビュー</h1>
        <div id="preview-area" class="bg-light" v-html="articleDescription"></div>
        <button @click="onSave" class="btn btn-primary">投稿内容を保存</button>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="https://unpkg.com/vue@next"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="{{ asset('js/article.js') }}"></script>
@endsection
