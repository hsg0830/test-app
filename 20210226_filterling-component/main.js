const app = Vue.createApp({
  data() {
    return {
      articles: [
        { title: 'これはどう綴る？', category: 1 },
        { title: 'いつもつけて書く実例', category: 3 },
        { title: '発音規則の紹介', category: 2 },
        { title: '南北で綴の異なる語', category: 1 },
        { title: 'ローマ字表記の原則', category: 4 }
      ],
      // categories: {
      //   0: 'すべて',
      //   1: '綴字法',
      //   2: '発音法',
      //   3: '分かち書き',
      //   4: 'その他'
      // },
      categories: [
        // {id: 0, name: 'すべて'},
        {id: 1, name: '綴字法'},
        {id: 2, name: '発音法'},
        {id: 3, name: '分かち書き'},
        {id: 4, name: 'その他'},
      ],
      selectedCategory: 0
    };
  },
  components: {
    'category-select-button': categorySelectButton,
    'articles-list': articlesList,
  },

  // methods: {
  //   changeCategory(categoryNo) {
  //     this.selectedCategory = categoryNo;
  //   }
  // }
});

app.mount('#app');
