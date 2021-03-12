const categorySelectButton = {
  template: `
    <div class="button-wrapper m-3 d-flex">
      <button
        class="btn btn-primary d-block m-2"
        :class="getClasses(0)"
        @click="getCategoryNo(0)">すべて
      </button>
      <button
        v-for="category in categories"
        class="btn btn-primary d-block m-2"
        :class="getClasses(category.id)"
        @click="getCategoryNo(category.id)">
        {{ category.name }}
      </button>
    </div>
  `,
  props: ['modelValue', 'categories'],
  methods: {
    getCategoryNo(category) {
      const categoryNo = Number.parseInt(category);
      // this.$emit('child-click', categoryNo);
      this.$emit('update:modelValue', categoryNo); // ここで v-model（=modelValue）の更新を親へ通知（changeCategoryを省略できます）
    },
    // おまけ： クリックされたボタンを色を変更しています
    getClasses(index) {
      return parseInt(this.modelValue) === parseInt(index) ? 'btn-info' : 'btn-primary';
    }
  },
  emits: ['update:modelValue'] // ← Warning が出る場合があるのでつけてますがなくても動きます
};
