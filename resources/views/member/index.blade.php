@extends('common.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/member.css') }}">
@endsection

@section('content')
  <div id="app" class="container p-3">
    <h1 class="mb-4">名簿管理</h1>

    <!-- 一覧 -->
    <div v-if="isIndex">
      <h2>登録されているお名前一覧</h2>
      <table class="table mx-auto">
        <thead>
          <tr>
            <th scope="col">名前</th>
            <th>変更・削除ボタン</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="member in members" :key="member.id">
            <td v-text="member.name"></td>
            <td>
              <button class="btn btn-primary mr-2" @click="toEdit(member)">変更</button>
              <button class="btn btn-danger mr-2" @click="onDelete(member)">削除</button>
            </td>
          </tr>
        </tbody>
      </table>

      <h2>お名前の新規登録</h2>
      <button class="btn btn-info" @click="toCreate()">お名前の新規登録はこちらから</button>
    </div>

    <div v-if="isCreate || isEdit">
      <h2 v-if="isCreate">新しいお名前を登録</h2>
      <h2 v-else>お名前を変更</h2>
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          placeholder="例：山田太郎"
          v-model="currentMember.name"
          aria-label="Membername"
          aria-describedby="basic-addon1"
        />
        <button type="button" class="btn btn-danger mr-2" @click="toIndex()">キャンセル</button>
        <button type="button" class="btn btn-success" v-if="isCreate" @click="onSave()">お名前を保存</button>
        <button type="button" class="btn btn-warning" v-if="isEdit" @click="onSave()">変更内容を保存</button>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('/js/member.js') }}"></script>
@endsection