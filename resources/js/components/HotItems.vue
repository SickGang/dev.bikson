<template>
  <div class="title-block text-center p-5" ref="anchor-1" id="anchor-0">
    <h1>Горячие новинки</h1>

  <div v-for="item in response" class="item-section d-flex flex-column flex-md-row align-items-center p-md-5">
    <div class="item-section_link col-lg-8">
      <a href="#">
        <img :src="item.img_url" alt="">
      </a>
    </div>
    <div class="item-section_info d-flex flex-column col-lg-4 mt-0 mt-sm-3">
      <div class="item-section_info_top">
        <h3>{{item.title}}</h3>
        <span>{{item.price}} руб</span>
      </div>
      <div class="item-section_info_bottom">
        <div class="item-section_info_bottom-button mt-3">
          <a @click="addToCart(item)" class="item-button" href="#">Купить</a>
        </div>
      </div>
    </div>
  </div>

</div>
</template>

<script>
export default {
  data() {
    return {
      response: ''
    }
  },
  created() {
    this.getItems()
  },
  methods: {
    getItems() {
      axios.post('/getItems', {
        name: ''
      })
      .then(response => {
        this.response = response.data
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    addToCart(item) {
      event.preventDefault()
      this.$store.commit('addToCart', item)
    }
  }
}
</script>
