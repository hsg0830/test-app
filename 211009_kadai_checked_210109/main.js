const NameList = {
  data() {
    return {
      users: [
        { id: 1, name: "太郎" },
        { id: 2, name: "次郎" },
        { id: 3, name: "三郎" },
      ],
      currentState: 'index',
      // ✅ 他の情報もまとめて管理できますので、`currentUser` としてデータ保持しておくと後々楽できるかと思います。
      // currentName: '',
      currentUser: {}
    };
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
    toIndex() {
      this.currentState = 'index';
    },
    toCreate() {
      this.currentState = 'create';
      this.currentUser = {}; // ✅ currentUserを初期化するために、ここを追加しました
    },
//    toEdit(name) {
//      this.currentState = 'edit';
//      this.currentName = name;
//    },
    toEdit(user) {
      this.currentState = 'edit';
      this.currentUser = user; // ✅ 名前以外も一括で管理できるので currentUser へ変更しました
    },
  }
};

Vue.createApp(NameList).mount("#app");

// new Vue({
//   data: () => {
//     return {
//       users: [
//         { id: 1, name: "太郎" },
//         { id: 2, name: "次郎" },
//         { id: 3, name: "三郎" },
//       ],
//     };
//   },
// }).mount('#app');
