const articlesList = {
  template: `
      <ul class="article_list list-group m-3" v-for="item in filterdList">
        <li class="list-group-item">
          【{{ getCategoryName(item.category) }}】
          {{ item.title }}
        </li>
      </ul>`,
  props: ['articles', 'categories', 'selectedCategory'],
  computed: {
    filterdList() {
      if (this.selectedCategory === 0) {
        return this.articles;
      } else {
        return this.articles.filter((item) => item.category === this.selectedCategory);
      }
    }
  },
  methods: {
    getCategoryName(categoryId) {
      const result = this.categories.find((category) => category.id === categoryId);
      return result.name;
    }
  }
};
