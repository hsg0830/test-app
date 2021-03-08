<html>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
  <div id="app" class="container p-3">
    <h1 class="mb-4">シンプルなCMSのサンプル</h1>

    <!-- 一覧表示部分 -->
    <div v-if="isStatusIndex">
      <div class="text-right pb-4">
        <button type="button" class="btn btn-success" @click="changeStatus('create')">追加</button>
      </div>
      <table class="table">
        <tr v-for="post in posts">
          <td v-text="post.title"></td>
          <td class="text-right">
            <a :href="'/post/'+ post.id" class="btn btn-light mr-2" target="_blank">確認</a>
            <button type="button" class="btn btn-warning mr-2" @click="setCurrentPost(post)">変更</button>
            <button type="button" class="btn btn-danger" @click="onDelete(post)">削除</button>
          </td>
        </tr>
      </table>
    </div>

    <!--  エディタ表示部分  -->
    <div v-if="isStatusCreate || isStatusEdit">

      <input class="form-control mb-3" type="text" placeholder="タイトル" v-model="postTitle">

      <!-- ここにリッチテキスト・エディタが表示されます -->
      <div id="editor"></div>

      <div class="text-right pt-4">
        <button type="button" class="btn btn-secondary mr-2" @click="changeStatus('index')">キャンセル</button>
        <button type="button" class="btn btn-primary" @click="onSave">保存する</button>
      </div>
    </div>

  </div>
  <script src="https://unpkg.com/vue@3.0.2/dist/vue.global.prod.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
  <script>
    Vue.createApp({
      data() {
        return {
          status: 'index', // 👈 ここの内容で表示切り替え
          posts: [],
          currentPost: {},
          postTitle: '', // タイトル
          richEditor: null // CKEditorのインスタンス
        }
      },
      methods: {
        initRichEditor(defaultDescription) {
          const target = document.querySelector('#editor');
          ClassicEditor.create(target)
            .then(editor => {
              this.postTitle = this.currentPost.title || '';
              this.richEditor = editor;
              this.richEditor.setData(defaultDescription);
            });
        },
        getPosts() {
          const url = '/post/list';
          axios.get(url)
            .then(response => {
              this.posts = response.data;
            });
        },
        setCurrentPost(post) {
          this.currentPost = post;
          this.status = 'edit';
        },
        changeStatus(status) {
          this.status = status;
        },
        onSave() {
          if (confirm('保存します。よろしいですか？')) {
            let url = '';
            let method = '';

            if (this.isStatusCreate) {
              url = '/post';
              method = 'POST';
            } else if (this.isStatusEdit) {
              url = `/post/${this.currentPost.id}`;
              method = 'PUT';
            }

            const params = {
              _method: method,
              title: this.postTitle,
              description: this.richEditor.getData()
            };

            axios.post(url, params)
              .then(response => {
                // console.log(params);
                if (response.data.result === true) {
                  this.getPosts();
                  this.changeStatus('index');
                }
              })
              .catch(error => {
                console.log(error); // エラーの場合
              });
          }
        },
        onDelete(post) {
          if (confirm('削除します。よろしいですか？')) {
            const url = `/post/${post.id}`;
            axios.delete(url)
              .then(response => {
                if (response.data.result === true) {
                  this.getPosts();
                }
              });
          }
        }
      },
      computed: {
        isStatusIndex() {
          return (this.status === 'index');
        },
        isStatusCreate() {
          return (this.status === 'create');
        },
        isStatusEdit() {
          return (this.status === 'edit');
        }
      },
      watch: {
        status(value) {
          if (value === 'create') {
            this.currentPost = {};
          }

          const editorKeys = ['create', 'edit'];
          const defaultDescription = (value === 'edit') ? this.currentPost.description : '';

          if (editorKeys.includes(value)) { // 👈 `create` か `edit` の場合だけ CKEditor を起動
            Vue.nextTick(() => {
              this.initRichEditor(defaultDescription);
            });
          }
        }
      },
      setup() {
        return {
          richEditor: Vue.reactive({}) // 👈 reactive変数をつくる
        }
      },
      mounted() {
        this.getPosts();
      }
    }).mount('#app');

  </script>
</body>

</html>
