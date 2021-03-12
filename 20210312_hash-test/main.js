new Vue({
  el: '#app',
  data: {
    colors: [
      { id: 1, name: '赤', code: '#ff0000', textColor: '#ffffff' },
      { id: 2, name: '青', code: '#0000ff', textColor: '#ffffff' },
      { id: 3, name: '黄色', code: '#ffff00', textColor: '#000000' },
      { id: 4, name: '白', code: '#ffffff', textColor: '#000000' },
      { id: 5, name: '黒', code: '#000000', textColor: '#ffffff' },
    ],
    selectedColorId: '',
  },
  methods: {
    parseHash: function () {
      // ハッシュからパラメータを取り出す

      const hash = location.hash.substr(1);
      const hashes = hash.split(',');

      for (let i = 0; i < hashes.length; i++) {
        let hashKeyValue = hashes[i].split('=');
        let key = hashKeyValue[0];
        let value = hashKeyValue[1];

        if (value) {
          if (key === 'id') {
            this.selectedColorId = parseInt(value);
          }
        }
      }
    },
  },
  computed: {
    selectedColor() {
      // 選択された色のデータを取得する
      return this.colors.find((color) => color.id === this.selectedColorId);
    },
  },
  mounted() {
    window.addEventListener('hashchange', this.parseHash);
    this.parseHash();
  },
});
