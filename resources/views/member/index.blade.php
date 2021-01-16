<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>名簿</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
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
        <!--　`currentMember` は省略してもOKです -->
        <!--
        <button type="button" class="btn btn-success" v-if="isCreate" @click="onSave(currentMember)">お名前を保存</button>
        <button type="button" class="btn btn-warning" v-if="isEdit" @click="onSave(currentMember)">変更内容を保存</button>
        -->
        <!--  また、引数がないときはカッコ()を省略できます  -->
        <button type="button" class="btn btn-success" v-if="isCreate" @click="onSave">お名前を保存</button>
        <button type="button" class="btn btn-warning" v-if="isEdit" @click="onSave">変更内容を保存</button>
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
        currentState: 'index',
        members: [],
        currentMember: {},
        // memberName: '',
      }
    },
    computed: {
      isIndex() {
        return this.currentState === 'index';
      },
      isCreate() {
        return this.currentState === 'create';
      },
      isEdit() {
        return this.currentState === 'edit';
      },
    },
    methods: {
      getMembers() {
        const url = '/member/list';
        axios.get(url)
          .then(response => {
            this.members = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      },
      toIndex() {
        this.currentState = 'index';
      },
      toCreate() {
        this.currentState = 'create';
        this.currentMember = {};
      },
      toEdit(member) {
        this.currentState = 'edit';

        // オブジェクトを「別のもの」としてコピーします。
        // これは、変更ボタンクリック -> タイトル変更 -> キャンセル -> 保存していないのに一覧のタイトル表示が変更になってしまうためです。
        // （ post/index.blade.php は CKEditor を使っている関係上問題ないようになっていましたが、この部分のサンプルとしては適切でなかったです。すみません ^^;）
        // [参考URL]:
        // https://blog.capilano-fw.com/?p=7724#i-2

        // this.currentMember = member;
        this.currentMember = Object.assign({}, member);

      },

      // this.currentMemberとして取得できるので、引数 `currentMember` は省略してもOKです
      // onSave(currentMember) {

      onSave() {
        if(confirm('保存します。よろしいですか？')) {
          let url = '';
          let method = '';

          if(this.isCreate) {
            url = '/member';
            method = 'POST';
          } else if(this.isEdit) {
            url = `/member/${this.currentMember.id}`;
            method = 'PUT';
          }

          const params = {
            _method: method,
            name: this.currentMember.name,
          };

          axios.post(url, params)
            .then(response => {
              if(response.data.result === true) {
                this.getMembers();
                this.toIndex();
              }
            })
            .catch(error => {
              console.log(error);
            });
        }
      },
      onDelete(member) {
        if(confirm('削除します。よろしいですか？')) {
          const url = `/member/${member.id}`;
          axios.delete(url)
            .then(response => {
              if(response.data.result === true) {
                this.getMembers();
              }
          });
        }
      }
    },
    mounted() {
      this.getMembers();
    }
  }).mount('#app');
</script>
</body>
</html>
