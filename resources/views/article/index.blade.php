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
          <li id="tabs-menu-0" class="category-tabs" @click="selectCategory(0)">전체</li>
          <li id="tabs-menu-1" class="category-tabs" @click="selectCategory(1)">맞춤법</li>
          <li id="tabs-menu-2" class="category-tabs" @click="selectCategory(2)">발음</li>
          <li id="tabs-menu-3" class="category-tabs" @click="selectCategory(3)">띄여쓰기</li>
          <li id="tabs-menu-4" class="category-tabs" @click="selectCategory(4)">기타</li>
        </ul>
      </div>
      <ul class="list-group">
        {{-- <li class="list-group-item" v-for="item in items.data">【@{{ categories[item.category_id] }}】@{{ item.title }}</li> --}}
        <li class="list-group-item" v-for="item in items.data">【@{{ item.category.name }}】@{{ item.title }}</li>
      </ul>
      {{-- <div id="tabs-content-a" class="list-container__wrapper">
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
      </div> --}}
    </div>

    <v-pagination :data="items" @move-page="movePage($event)"></v-pagination>
  </main>
  <!-- ↑↑↑メインコンテンツ↑↑↑ -->
@endsection

@section('js')
  <script src="{{ asset('js/vue/components/paginationComponent.js') }}"></script>
  <script src="https://unpkg.com/vue@3.0.2/dist/vue.global.prod.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
  <!-- 規範関連ページ用 -->
  {{-- <script src="{{ asset('js/norm.js') }}"></script> --}}

  <script>
    const app = Vue.createApp({
      data() {
        return {
          page: 1,
          categoryNo: 0,
          items: [],
          // categories: {},
        }
      },
      components: {
        'v-pagination': paginationComponent,
      },
      methods: {
        getItems() {
          const url = '/articles/pagination';
          axios.get(url, {
            params: {
              page: this.page,
              categoryNo: this.categoryNo,
            }
          })
            .then((response) => {
              // this.items = response.data[0];
              this.items = response.data;

              //カテゴリー名のオブジェクトを作成
              // for (let i = 0; i < response.data[1].length; i++) {
              //   this.categories[i+1] = response.data[1][i].name;
              // }
              // console.log(this.categories);
            });
        },
        movePage(page) {
          this.page = page;
          this.getItems();
        },
        selectCategory(categoryNo) {
          this.categoryNo = categoryNo;
          this.page = 1;
          const tabs = document.querySelectorAll('.category-tabs');
          tabs.forEach(tab => {
            tab.classList.remove('active');
          })
          const selectedTab = document.querySelector(`#tabs-menu-${this.categoryNo}`);
          selectedTab.classList.add('active');
          this.getItems();
        }
      },
      mounted() {
        this.selectCategory(0);
      }
    });

    app.mount('#main');

  </script>
@endsection


