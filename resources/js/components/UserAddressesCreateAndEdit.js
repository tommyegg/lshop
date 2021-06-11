Vue.component('user-addresses-create-and-edit', {
  data() {
    return {
      city: '', // 縣市
      district: '', // 鄉鎮
    }
  },
  methods: {
    onDistrictChanged(val) {
      if (val.length === 2) {
        this.city = val[0];
        this.district = val[1];
      }
    }
  }
});
