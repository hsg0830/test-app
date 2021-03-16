@extends('common.app2')

@section('title', 'ファイル一覧')

@section('css')
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .content {
      margin: 0 auto;
      padding: 40px;
    }

    .modal {
      /* display: none; */
      height: 100vh;
      position: fixed;
      top: 0;
      width: 100%;
    }

    .modal__bg {
      background: rgba(0, 0, 0, 0.8);
      height: 100vh;
      position: absolute;
      width: 100%;
    }

    .modal__content {
      background: #fff;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      padding: 40px;
      width: 80%;
    }

  </style>
@endsection

@section('content')

  <div id="app">
    <h2>ファイルをアップロード</h2>
    <div class="m-3 p-5 border">
      <div class="mb-3">
        <label for="type" class="form-label">ファイルの種類</label>
        <select id="type" class="form-select" v-model="uploadType" @change="clearPreview">
          <option v-for="(value, key) in types" v-text="value" :value="key"></option>
        </select>
      </div>

      <div v-if="parseInt(uploadType) === 1">
        <div class="mb-3">
          <label for="image" class="form-label">画像ファイルを選択してください</label>
          <input class="form-control" type="file" accept="image/*" id="image" ref="image" @change="onFileChange">
        </div>

        <div class="mb-3">
          <img v-show="previewImage" :src="previewImage" alt="" />
        </div>

        <div class="mb-3">
          <label for="memo1" class="form-label">ファイルの説明を入力してください</label>
          <input class="form-control" type="text" id="memo1" v-model="memo">
        </div>
      </div>

      <div v-else-if="parseInt(uploadType) === 2">
        viedo upload用（途中）
        <div class="mb-3">
          <label for="video" class="form-label">動画ファイルを選択してください</label>
          <input class="form-control" type="file" accept="audio/mp4" id="video" ref="video" @change="onFileChange">
        </div>

        <div class="mb-3">
          <label for="poster" class="form-label">サムネイル用の画像ファイルを選択してください</label>
          <input class="form-control" type="file" accept="image/*" id="poster" ref="poster" @change="onPosterChange">
        </div>

        <div class="mb-3">
          <img v-show="previewImage" :src="previewImage" alt="" />
        </div>

        <div class="mb-3">
          <label for="memo2" class="form-label">ファイルの説明を入力してください</label>
          <input class="form-control" type="text" id="memo2" v-model="memo">
        </div>
      </div>

      <div>
        <button type="button" class="btn btn-primary mb-3" @click=onUpload>ファイルをアップロード</button>
      </div>
    </div>


    <div class="content">
      <button class="btn btn-success" @click="modalOpen">保存されているメディアの一覧</button>
    </div>

    <div class="modal js-modal">
      <div class="modal__bg js-modal-close" @click="modalClose"></div>

      <div class="modal__content">

        <h2>保存されているファイル一覧</h2>

        <div class="input-group mb-3">
          <label for="type">ファイルの種類</label>
          <select id="type" class="form-select" v-model="currentType">
            <option v-for="(value, key) in types" v-text="value" :value="key"></option>
          </select>
        </div>

        <h3>列をクリックするとURLがコピーされます。</h3>

        <table class="table table-striped mx-auto">
          <tr>
            <th>種類</th>
            <th>メモ</th>
            <th>URL</th>
          </tr>
          <tr v-for="media in filterdList" :key="media.id" @click="copyToClipboard(media)">
            <td v-text="media.type"></td>
            <td v-text="media.memo"></td>
            <td v-text="media.path"></td>
            <td><img :src="getMediaPath(media)" alt="NO IMAGE" style="width: 80%; height: 50%;"></td>
          </tr>
        </table>
        <button class="btn btn-danger" @click="modalClose">閉じる</button>
      </div>
    </div>

  </div>
@endsection

@section('js')
  <script>
    Vue.createApp({
      data() {
        return {
          medias: [],
          types: {
            1: 'image',
            2: 'video'
          },
          uploadType: 1,
          uplodedFile: {},
          posterImg: '',
          previewImage: '',
          memo: '',
          currentType: 1,
        };
      },
      computed: {
        filterdList() {
          return this.medias.filter((item) => item.type === this.types[parseInt(this.currentType)]);
        }
      },
      methods: {
        getList() {
          const url = 'medias/list';
          axios.get(url)
            .then(response => {
              this.medias = response.data;
            })
        },
        modalOpen() {
          $('.js-modal').fadeIn();
        },
        modalClose() {
          $('.js-modal').fadeOut();
          this.currentType = 1;
        },
        getMediaPath(media) {
          return `${media.path}`;
        },
        copyToClipboard(media) {
          const copyTarget = media.path;
          const el = document.createElement('textarea');
          el.value = copyTarget;
          el.setAttribute('readonly', '');
          el.style = {
            position: 'absolute',
            left: '-9999px'
          };
          document.body.appendChild(el);
          el.select();
          document.execCommand('copy');
          document.body.removeChild(el);
          alert(`コピーできました！ : ${copyTarget}`);
        },
        onFileChange(e) {
          const file = e.target.files[0] || e.dataTransfer.files[0];
          if (parseInt(this.uploadType) === 1) {
            this.createImage(file);
            this.posterImg = '';
          }
          this.uplodedFile = file;
          // console.log(this.uplodedFile);
        },
        onPosterChange(e) {
          const file = e.target.files[0];
          this.posterImg = file;
          this.createImage(file);
          // console.log(this.posterImg);
        },
        //imageの場合のプレビュー表示
        createImage(file) {
          const reader = new FileReader();
          reader.onload = e => {
            this.previewImage = e.target.result;
          };
          reader.readAsDataURL(file);
        },
        clearPreview() {
          this.previewImage = '';
        },
        onUpload() {
          if (confirm('保存します。よろしいですか？')) {
            let formData = new FormData();
            formData.append('type', this.types[parseInt(this.uploadType)]);
            formData.append('memo', this.memo);
            // formData.append('poster', this.posterImg); //まだLaravel側未実装
            formData.append('media', this.uplodedFile);
            // for (item of formData) {
            //   console.log(item);
            // }
            axios.post('/medias/upload', formData)
              .then(response => {
                if (response.data.result) {
                  alert('アップロード成功！');
                  this.uploadType = 1;
                  this.memo = '';
                  this.$refs['image'].value = '';
                  this.previewImage = '';
                  this.getList();
                }
              })
              .catch(error => {
                console.log(error);
              });
          }
        },
      },
      mounted() {
        this.getList();
      }
    }).mount('#app');

  </script>
@endsection
