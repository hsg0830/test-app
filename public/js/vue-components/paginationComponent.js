const paginationComponent = {
  props: {
    data: {}, // paginate()で取得したデータ
  },
  data() {
    return {
      range: 3,
      size: 6,
      frontDot: false,
      endDot: false,
    };
  },
  methods: {
    move(page) {
      if (!this.isCurrentPage(page)) {
        this.$emit('move-page', page);
      }
    },
    isCurrentPage(page) {
      return this.data.current_page == page;
    },
    isActive(page) {
      if (this.isCurrentPage(page)) {
        return 'active';
      }
    },
    calRange(start, end) {
      const range = [];
      for (let i = start; i <= end; i++) {
        range.push(i);
      }
      return range;
    },
  },
  computed: {
    sizeCheck() {
      if (this.data.last_page < this.size) {
        return false;
      }
      return true;
    },
    hasPrev() {
      return this.data.prev_page_url != null;
    },
    hasNext() {
      return this.data.next_page_url != null;
    },
    frontPageRange() {
      if (!this.sizeCheck) {
        this.frontDot = false;
        this.endDot = false;
        return this.calRange(1, this.data.last_page);
      }
      return this.calRange(1, 2);
    },
    middlePageRange() {
      if (!this.sizeCheck) {
        return [];
      }

      let start = '';
      let end = '';

      if (this.data.current_page <= this.range) {
        start = 3;
        end = this.range + 2;
        this.frontDot = false;
        this.endDot = true;
      } else if (this.data.current_page > this.data.last_page - this.range) {
        start = this.data.last_page - this.range - 1;
        end = this.data.last_page - 2;
        this.frontDot = true;
        this.endDot = false;
      } else {
        start = this.data.current_page - Math.floor(this.range / 2);
        end = this.data.current_page + Math.floor(this.range / 2);
        this.frontDot = true;
        this.endDot = true;
      }
      return this.calRange(start, end);
    },
    endPageRange() {
      if (!this.sizeCheck) {
        return [];
      }
      return this.calRange(this.data.last_page - 1, this.data.last_page);
    },
  },
  template: `
  <ul class="v-pagination">
    <li
      v-show="hasPrev"
      @click="move(data.current_page-1)"
    >&laquo;</li>
    <li
      v-for="page in frontPageRange"
      :key="page"
      @click="move(page)"
      :class="isActive(page)"
    >{{page}}</li>
    <li v-show="frontDot" class="disabled">…</li>
    <li
      v-for="page in middlePageRange"
      :key="page"
      @click="move(page)"
      :class="isActive(page)"
    >{{page}}</li>
    <li v-show="endDot" class="disabled">…</li>
    <li
      v-for="page in endPageRange"
      :key="page"
      @click="move(page)"
      :class="isActive(page)"
    >{{page}}</li>
    <li
      v-show="hasNext"
      @click="move(data.current_page+1)"
    >&raquo;</li>
  </ul>
  `,
};
