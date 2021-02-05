@extends('common.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/member.css') }}">
@endsection

@section('content')
  <div id="app" class="container p-3">
    <h1 class="mb-4">名簿管理</h1>

    {{-- <div v-if="hasErrors">
      <div class="alert alert-danger" role="alert" v-text="errors"></div>
    </div> --}}
    <!-- 一覧 -->
    <div v-if="isIndex">
      <h2>登録されているメンバー一覧</h2>
      <table class="table mx-auto">
        <thead>
          <tr>
            <th scope="col">名前</th>
            <th scope="col">メールアドレス</th>
            <th scope="col">性別</th>
            <th>変更・削除ボタン</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="member in members" :key="member.id">
            <td v-text="member.name"></td>
            <td v-text="member.email"></td>

            <!-- 【変更】性別をデータから表示することで、性別一元管理しています -->
            <td v-text="sexes[member.sex]"></td>

            <td>
              <button class="btn btn-primary mr-2" @click="toEdit(member)">変更</button>
              <button class="btn btn-danger mr-2" @click="onDelete(member)">削除</button>
            </td>
          </tr>
        </tbody>
      </table>

      <h2>メンバーの新規登録</h2>
      <button class="btn btn-info" @click="toCreate()">メンバーの新規登録はこちらから</button>
    </div>

    <div v-if="isCreate || isEdit">
      <h2 v-if="isCreate">新しいメンバーを登録</h2>
      <h2 v-else>メンバーの情報を変更</h2>
      <div class="alert alert-danger" role="alert" v-if="errors.name" v-text="errors.name"></div>
      <div class="input-group mb-3">
        <label for="name">お名前：</label>
        <input
          id="name"
          type="text"
          class="form-control"
          placeholder="例：山田太郎"
          v-model="currentMember.name"
          aria-label="MemberName"
        />
      </div>

      <div class="alert alert-danger" role="alert" v-if="errors.email" v-text="errors.email"></div>
      <div class="input-group mb-3">
        <label for="email">メールアドレス：</label>
        <input
          id="email"
          type="email"
          class="form-control"
          placeholder="例：user@example.com"
          v-model="currentMember.email"
          aria-label="MemberEmail"
        />
      </div>

      <div class="alert alert-danger" role="alert" v-if="errors.sex" v-text="errors.sex"></div>
      <div class="input-group mb-3">
        <label for="sex">性別：</label>
        <select id="sex" class="form-select" aria-label="MemberSexuality" v-model="currentMember.sex">
          {{-- <option selected>お選びください</option> --}}
{{--          <option value="1">男</option>--}}
{{--          <option value="2">女</option>--}}
          <!-- 【変更】性別をデータから表示することで、一覧でも使えるようにしています -->
          <option
              v-for="(value,key) in sexes"
              v-text="value"
              :value="key"></option>
        </select>
      </div>

      <div class="alert alert-danger" role="alert" v-if="errors.password" v-text="errors.password"></div>
      <div class="input-group mb-3">
        <label for="password">パスワード：</label>
        <input
          id="password"
          type="password"
          class="form-control"
          placeholder="パスワードを入力"
          v-model="currentMember.password"
          aria-label="MemberPassword"
        />
      </div>
      <div class="input-group mb-3">
        <label for="password-confirmation">パスワード再入力：</label>
        <input
          id="password-confirmation"
          type="password"
          class="form-control"
          placeholder="確認のためパスワードをもう一度入力"
          v-model="pwConfirmation"
          aria-label="MemberPasswordConfirmation"
        />
      </div>
        <button type="button" class="btn btn-danger mr-2" @click="toIndex()">キャンセル</button>
        <button type="button" class="btn btn-success" v-if="isCreate" @click="onSave()">メンバーを保存</button>
        <button type="button" class="btn btn-warning" v-if="isEdit" @click="onSave()">変更内容を保存</button>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('/js/member.js') }}"></script>
@endsection
