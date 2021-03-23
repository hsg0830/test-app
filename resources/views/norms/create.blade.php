@extends('common.ol')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/norm.css') }}">

  <style>
    #main {
      font-size: 2rem;
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

@section('main')
  <div id="main">
    <h1>投稿フォーム</h1>

    {{-- タイトル部 --}}
    <div style="border: 2px solid brown; padding:0.5rem; background-color: lemonchiffon; margin: 2rem 0">
      <div class="mb-3">
        <label for="category">カテゴリー：</label>
        <select id="category" class="form-select form-select-bg" v-model="articleCategory">
          <option v-for="category in categories" v-text="category.name" :value="category.id"></option>
        </select>
      </div>

      <div class="mb-3">
        <label for="title">記事のタイトル：</label>
        <input id="title" type="text" class="form-control" v-model="articleTitle" />
      </div>

      <div class="mb-3">
        <label for="introduction">イントロダクション：</label>
        <textarea id="introduction" class="form-control" rows="10" v-model="articleIntroduction"></textarea>
      </div>
    </div>

    {{-- サブコンテンツ部 --}}
    <div id="sub-form-area" class="p-3" style="background-color:skyblue">
      <div id="sub-section-0" class="mb-3" style="background-color:pink">
        <div class="mb-3">
          <label for="sub-no-0">サブタイトル番号：</label>
          <input id="sub-no-0" type="text" class="form-control" value="1" readonly />
        </div>

        <div class="mb-3">
          <label for="sub-title-0">サブタイトル：</label>
          <input id="sub-title-0" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="sub-content-0">本文：</label>
          <textarea id="sub-content-0" class="form-control" rows="10"></textarea>
        </div>
      </div>

    </div>
    <button v-if="formBlockCount > 0" class="btn btn-danger btn-block" @click="removeForm">末尾のフォームブロックを削除</button>

    <button class="btn btn-block btn-primary" @click="addFormBlock">入力フォームを追加</button>

    <button class="btn btn-block btn-success" @click="preview">投稿内容をプレビュー</button>

    {{-- プレビュー用モーダル --}}

    <div class="modal js-modal">
      <div class="modal__bg js-modal-close" @click="modalClose"></div>

      <div class="modal__content">

        <main id="main">
          <!-- タイトル部 -->
          <div class="title-block">
            <div class="title-block__category" v-text="articleCategory"></div>
            <h1 class="title-block__title" v-text="articleTitle"></h1>
            <div class="title-block__date">갱신날자: <time>XXXX-XX-XX</time></div>
          </div>
          <!-- タイトル部 -->

          <!-- 本文部 -->
          <div class="content-block">
            <section v-for="item in subContents" class="content-section">
              <div class="section-title-block">
                <span class="section-title-block__number" v-text="item.no"></span>
                <h3 class="section-title-block__title" v-text="item.title"></h3>
              </div>
              <div class="section-content-block" v-html="item.description"></div>
            </section>
          </div>
          <!-- 本文部 -->
        </main>

        <button class="btn btn-danger" @click="modalClose">閉じる</button>
        <button class="btn btn-primary" @click="onSave">投稿を保存する</button>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="https://unpkg.com/vue@next"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script>
    const app = Vue.createApp({
      data() {
        return {
          categories: [], //DBから取得してきたデータ
          articleCategory: 1,
          articleTitle: '',
          articleIntroduction: '',
          formBlockCount: 0,
          subContents: [],
        }
      },
      created() {
        this.getCategories();
      },
      methods: {
        getCategories() {
          const url = '/norms/categories';
          axios.get(url)
            .then((response) => {
              this.categories = response.data;
            });
        },
        addFormBlock() {
          // フォームブロックの数を追加
          this.formBlockCount++;

          // 最後にformBlock要素をappendする親要素
          const formArea = document.querySelector('#sub-form-area');

          // フォームブロックを作成
          const formBlock = document.createElement('div');
          formBlock.id = `sub-section-${this.formBlockCount}`;
          formBlock.classList.add('mb-3');
          formBlock.style.backgroundColor = 'pink';

          // サブタイトル番号エリア
          const subNoBlock = document.createElement('div');
          subNoBlock.classList.add('mb-3');
          const subNoLabel = document.createElement('label');
          subNoLabel.htmlFor = `sub-no-${this.formBlockCount}`;
          subNoLabel.textContent = 'サブタイトルの番号：';
          subNoBlock.appendChild(subNoLabel);
          const subNoInput = document.createElement('input');
          subNoInput.id = `sub-no-${this.formBlockCount}`;
          subNoInput.type = 'text';
          subNoInput.value = this.formBlockCount + 1;
          subNoInput.readOnly = true;
          subNoInput.classList.add('form-control');
          subNoBlock.appendChild(subNoInput);
          formBlock.appendChild(subNoBlock);

          // サブタイトルエリア
          const subTitleBlock = document.createElement('div');
          subTitleBlock.classList.add('mb-3');
          const subTitleLabel = document.createElement('label');
          subTitleLabel.htmlFor = `sub-title-${this.formBlockCount}`;
          subTitleLabel.textContent = 'サブタイトル：';
          subTitleBlock.appendChild(subTitleLabel);
          const subTitleInput = document.createElement('input');
          subTitleInput.id = `sub-title-${this.formBlockCount}`;
          subTitleInput.type = 'text';
          subTitleInput.classList.add('form-control');
          subTitleBlock.appendChild(subTitleInput);
          formBlock.appendChild(subTitleBlock);

          // 本文エリア
          const subContentBlock = document.createElement('div');
          subContentBlock.classList.add('mb-3');
          const subContentLabel = document.createElement('label');
          subContentLabel.htmlFor = `sub-content-${this.formBlockCount}`;
          subContentLabel.textContent = '本文：';
          subContentBlock.appendChild(subContentLabel);
          const subContentInput = document.createElement('textarea');
          subContentInput.id = `sub-content-${this.formBlockCount}`;
          subContentInput.classList.add('form-control');
          subContentInput.rows = 10;
          subContentBlock.appendChild(subContentInput);
          formBlock.appendChild(subContentBlock);

          // const removeBtn = document.createElement('button');
          // removeBtn.classList.add('btn', 'btn-danger');
          // removeBtn.textContent = 'フォームを削除';
          // removeBtn.addEventListener('click', () => {
          //   this.removeForm(this.formBlockCount);
          // });
          // formBlock.appendChild(removeBtn);

          // formBlockをformAreaに追加
          formArea.appendChild(formBlock);

        },
        removeForm() {
          const removeObj = document.querySelector(`#sub-section-${this.formBlockCount}`);
          removeObj.remove();
          this.formBlockCount--;
        },
        preview() {
          this.subContents = [];

          for (let i = 0; i < this.formBlockCount + 1; i++) {
            const no = document.querySelector(`#sub-no-${i}`).value;
            const title = document.querySelector(`#sub-title-${i}`).value;
            const content = document.querySelector(`#sub-content-${i}`).value;

            const subContent = {
              no: parseInt(no),
              title: title,
              description: content,
            };

            this.subContents.push(subContent);

            this.modalOpen();
            // console.log(this.subContents);
          }
        },
        modalOpen() {
          $('.js-modal').fadeIn();
        },
        modalClose() {
          $('.js-modal').fadeOut();
        },
        onSave() {
          if (confirm('保存します。よろしいですか？')) {
            const url = '/norms/articles';
            const method = 'POST';

            const params = {
              _method: method,
              title: this.articleTitle,
              category: this.articleCategory,
              introduction: this.articleIntroduction,
              subContents: this.subContents,
            };

            axios
              .post(url, params)
              .then((response) => {
                if (response.data.result === true) {
                  alert('記事を保存しました。')
                }
              })
              .catch((error) => {
                if (error.response.status === 422) {
                  const responseErrors = error.response.data.errors;
                  console.log(responseErrors);
                  // let errors = {};

                  // for (const key in responseErrors) {
                  //   errors[key] = responseErrors[key][0];
                  // }
                  // console.log(errors);
                  // this.errors = errors;
                } else {
                  console.log(error);
                }
              });
          }
        },
      },
    });

    app.mount('#main');

  </script>
@endsection
