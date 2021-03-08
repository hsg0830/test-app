const app = Vue.createApp({
  data() {
    return {
      articleTitle: '',
      draft: '',
      articleDescription: '',
      formBlockCount: 0,
      category: 1,
    };
  },
  methods: {
    // フォームブロックを新規追加するメソッド
    addFormBlock() {
      // フォームブロックの数を追加
      this.formBlockCount++;

      // 最後に要素をappendする親要素
      const formArea = document.querySelector('#form');

      // フォームブロック
      const contentBlock = document.createElement('div');
      contentBlock.classList.add('content-block', 'bg-warning', 'mb-3', 'p-3');

      // タイトル入力欄を作成しフォームブロックに追加
      const inputTitle = document.createElement('input');
      inputTitle.type = 'text';
      inputTitle.id = `title${this.formBlockCount}`;
      inputTitle.classList.add('form-control', 'd-block', 'mb-3');
      contentBlock.appendChild(inputTitle);

      // 本文入力欄を作成しフォームブロックに追加
      const inputContent = document.createElement('textarea');
      inputContent.id = `content${this.formBlockCount}`;
      inputContent.classList.add('form-control', 'd-block', 'mb-3');
      contentBlock.appendChild(inputContent);

      // 作成したフォームブロックを親要素に追加
      formArea.appendChild(contentBlock);
    },
    // 最後のフォームブロックを削除するメソッド
    removeFormBlock() {
      const boxCount = document.querySelectorAll('.content-block').length;

      if (boxCount > 1) {
        const formArea = document.querySelector('#form');
        formArea.lastChild.remove();
      }
    },
    // 入力内容にスタイルを当てプレビュー表示させるメソッド
    combineDraft(e) {
      e.preventDefault();
      let previewArea = document.querySelector('#preview-area');
      this.draft = '';
      this.preview = '';
      // previewArea.innerHTML = "";

      // ページのタイトルにスタイルを当てプレビュー用の変数に追加
      const pageTitle = `<h2 class="bg-info">${this.articleTitle}</h2>`;
      previewArea += pageTitle;

      // フォームブロックの数を取得
      const boxCount = document.querySelectorAll('.content-block').length;

      // 子見出しと本文にスタイルを当てプレビュー用の変数に追加
      for (let i = 0; i < boxCount; i++) {
        const title = document.querySelector(`#title${i}`).value;
        const content = document.querySelector(`#content${i}`).value;

        const styledTitle = `<h3>${title}</h3>`;
        this.draft += styledTitle;
        const styledContent = `<div style="color:red;">${content}</div>`;
        this.draft += styledContent;
      }

      // previewArea.innerHTML += this.draft;
      this.articleDescription = this.draft;
    },
    onSave() {
      if (confirm('保存します。よろしいですか？')) {
        const url = '/norms';
        const method = 'POST';

        const params = {
          _method: method,
          title: this.articleTitle,
          description: this.articleDescription,
          category: this.category,
        };

        axios
          .post(url, params)
          .then((response) => {
            if (response.data.result === true) {
              // this.getMembers();
              //     this.toIndex();
            }
          })
          .catch((error) => {
            if (error.response.status === 422) {
              const responseErrors = error.response.data.errors;
              let errors = {};

              for (const key in responseErrors) {
                errors[key] = responseErrors[key][0];
              }
              console.log(errors);
              this.errors = errors;
            } else {
              console.log(error);
            }
          });
      }
    },
  },
});

app.mount('#app');
