Vue.createApp({
    data() {
        return {
            currentState: "index",
            members: [],
            currentMember: {},
            pwConfirm: "",
            errorStatus: 0,
            // errors: [],
            errors: {}, // 変更： エラーはオブジェクトで返ってきますのでこちらに変更しました
            // memberName: '',
            sexes: {    // 追加： 性別をデータで管理するようにしました（ご提案）
                1: '男',
                2: '女'
            }
        };
    },
    computed: {
        isIndex() {
            return this.currentState === "index";
        },
        isCreate() {
            return this.currentState === "create";
        },
        isEdit() {
            return this.currentState === "edit";
        },
        hasErrors () {
          return this.errorStatus === 422;
        },
        // passwordError() {
        //   if (this.errors) {
        //     if (this.errors.password) {
        //         return this.errors.password;
        //       }
        //   }
        //   return "";
        // },
    },
    methods: {
        getMembers() {
            const url = "/member/list";
            axios
                .get(url)
                .then((response) => {
                    this.members = response.data;
                    console.log(this.members);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        toIndex() {
            this.currentState = "index";
            this.pwConfirm = ''; // キャンセルした場合のデータ初期化をしています
        },
        toCreate() {
            this.currentState = "create";
            this.currentMember = {};
        },
        toEdit(member) {
            this.currentState = "edit";
            // this.currentMember = member; ※こうしたらキャンセルした場合に入力値が画面に反映されてしまう。
            this.currentMember = Object.assign({}, member);
            this.currentMember.password = "";
        },
        onSave() {
            // console.log(this.currentMember);
            // console.log(this.pwConfirm);

            if (!this.currentMember.name) {
                alert("お名前を入力してください。");
                return;
            }
            if (!this.currentMember.email) {
                alert("メールアドレスを入力してください。");
                return;
            }
            if (!this.currentMember.sex) {
                alert("性別を選択してください。");
                return;
            }
            if (!this.currentMember.password) {
                alert("パスワードを入力してください。");
                return;
            }
            if (!this.pwConfirm) {
                alert("確認のためパスワードをもう一度入力してください。");
                return;
            }
            if (this.currentMember.password !== this.pwConfirm) {
                alert("パスワードが一致しません。再度誤入力ください。");
                return;
            }

            if (confirm("保存します。よろしいですか？")) {
                let url = "";
                let method = "";

                if (this.isCreate) {
                    url = "/member";
                    method = "POST";
                } else if (this.isEdit) {
                    url = `/member/${this.currentMember.id}`;
                    method = "PUT";
                }

                const params = {
                    _method: method,
                    name: this.currentMember.name,
                    email: this.currentMember.email,
                    sex: this.currentMember.sex,
                    password: this.currentMember.password,
                    // pwConfirm: this.pwConfirm,

                    // 【追加】バリデーション・ルール「confirmed」の仕様にそって「password_confirmation」という名前で送信します
                    // 参考記事： https://blog.capilano-fw.com/?p=341#Confirmed
                    password_confirmation: this.pwConfirm,
                };

                axios
                    .post(url, params)
                    .then((response) => {
                        if (response.data.result === true) {
                            console.log(response);
                            this.getMembers();
                            this.toIndex();
                        }
                    })
                    .catch((error) => {
                        if (error.response.status === 422) {
                            this.errorStatus = 422;
                            this.errors = error.response.data.errors;
                            // console.log(this.errors);
                        } else {
                            console.log(error);
                        }
                    });
            }
        },
        onDelete(member) {
            if (confirm("削除します。よろしいですか？")) {
                const url = `/member/${member.id}`;
                axios.delete(url).then((response) => {
                    if (response.data.result === true) {
                        this.getMembers();
                    }
                });
            }
        },
    },
    watch: { // 追加
        currentState() { // ステータスが変更になったとき毎回実行される部分

            this.errorStatus = 0; // エラー・ステータスを初期化します

        }
    },
    mounted() {
        this.getMembers();
    },
}).mount("#app");
