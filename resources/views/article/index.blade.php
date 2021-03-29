@extends('common.ol')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/norm.css') }}" />
  <style>
    .v-pagination {
      display: flex;
      justify-content: space-between;
    }

    .v-pagination li {
      border: 1px solid brown;
      padding: 0.6rem 1.2rem;
      text-align: center;
      color: brown;
      cursor: pointer;
    }

    .v-pagination li.active {
      background-color: brown;
      color: #fff;
    }

    .v-pagination li.disabled {
      cursor: not-allowed;
    }

  </style>
@endsection

@section('main')
  <!-- ↓↓↓メインコンテンツ↓↓↓ -->
  <main id="main">
    <h1 class="norm-category-title">
      언어규범과 관련한 각종 해설
    </h1>
    <div class="list-container">
      <div class="list-container__selector">
        <category-select-button :categories="categories" v-model="categoryNo" @child-click="selectCategory">
        </category-select-button>
      </div>
      <div class="list-container__wrapper">
        <div class="list-item" v-for="item in items.data">
          <a href="show.html">
            <div class="list-item__header">
              <img src="../../img/bg_memo_thum.png" alt="" />
              <p class="title color">@{{ item . title }}</p>
            </div>
            <div class="list-item__content">
              <p class="lead">
                @{{ item . description }}
              </p>
              <div class="info">
                <p class="date">@{{ item . created_at }}</p>
                <p class="category">@{{ item . category . name }}</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <v-pagination :data="items" @move-page="movePage($event)"></v-pagination>
  </main>
  <!-- ↑↑↑メインコンテンツ↑↑↑ -->
@endsection

@section('js')
  <script src="{{ asset('js/vue-components/CategoryButton.js') }}"></script>
  <script src="{{ asset('js/vue-components/paginationComponent.js') }}"></script>
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
          categories: [],
        }
      },
      components: {
        'category-select-button': categorySelectButton,
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
              this.items = response.data[0];
              this.categories = response.data[1];
            });
        },
        movePage(page) {
          this.page = page;
          location.hash = `${this.page}%${this.categoryNo}`;
          this.getItems();
        },
        getHashValue() {
          const hashPage = parseInt(location.hash.substring(1));
          const hashCategoryNo = parseInt(location.hash.substring(1).slice(-1));

          if (hashPage > 0) {
            this.page = hashPage;
          } else {
            this.page = 1;
          }

          if (hashCategoryNo > 0) {
            this.categoryNo = hashCategoryNo;
          } else {
            this.categoryNo = 0;
          }
        },
        selectCategory(categoryNo) {
          this.categoryNo = categoryNo;
          const hashCategoryNo = parseInt(location.hash.substring(1).slice(-1));

          if (this.categoryNo !== hashCategoryNo) {
            this.page = 1;
          }

          location.hash = `${this.page}%${this.categoryNo}`;
          this.getItems();
        }
      },
      mounted() {
        this.getHashValue();
        this.selectCategory(this.categoryNo);
      }
    });

    app.mount('#main');

  </script>
@endsection
