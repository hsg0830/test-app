@extends('common.app')

@section('css')
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-2 m-auto pt-5">
      <form method="POST" action="multi_login">
        @csrf

        @error('auth')
          <div class="alert alert-danger" role="alert">
            &#x26A0; {{ $message }}
          </div>
        @enderror

        <div class="mb-3">
          <label for="email" class="form-label">メールアドレス</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">メールアドレス</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="パスワードを8文字以上で入力してください。">
        </div>

        <div class="mb-3">
          <label for="guard" class="form-label">ユーザータイプ</label>
          <select id="guard" name="guard" class="form-control">
            <option value="members">members</option>
            <option value="users">users</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">
            <input type="checkbox" name="remember">
            次回から省略
          </label>
        </div>

        <button type="submit" class="btn btn-primary mb-3">ログイン</button>

      </form>
    </div>
  </div>
@endsection
