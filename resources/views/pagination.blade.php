<html>

<head>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div id="app">
    <h1>Pagination Test</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="item in items.data" v-text="item.name"></li>
    </ul>

    <v-pagination :data="items" @move-page="movePage($event)"></v-pagination>
  </div>
  {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script> --}}
  <script src="{{ asset('js/vue/components/paginationComponent.js') }}"></script>
  <script src="https://unpkg.com/vue@3.0.2/dist/vue.global.prod.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
  <script>
    const app = Vue.createApp({
      data() {
        return {
          page: 1,
          items: [],
        }
      },
      components: {
        'v-pagination': paginationComponent,
      },
      methods: {
        getItems() {
          const url = '/ajax/pagination?page=' + this.page;
          axios.get(url)
            .then((response) => {
              this.items = response.data;
            });
        },
        movePage(page) {
          this.page = page; // ページ番号を更新
          this.getItems(); // Ajaxで新データを取得
        },
      },
      mounted() {
        this.getItems();
      }
    });

    app.mount('#app');

  </script>
</body>

@env('local')

@include('test.route_list')

@endenv

</html>
