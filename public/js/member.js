Vue.createApp({
  data() {
    return {
      currentState: "index",
      members: [],
      currentMember: {},
      // memberName: '',
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
    },
    toCreate() {
      this.currentState = "create";
      this.currentMember = {};
    },
    toEdit(member) {
      this.currentState = "edit";
      // this.currentMember = member; ※こうしたらキャンセルした場合に入力値が画面に反映されてしまう。
      this.currentMember = Object.assign({}, member);
    },
    onSave() {
      // console.log(this.currentMember);
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
            console.log(error);
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
  mounted() {
    this.getMembers();
  },
}).mount("#app");
