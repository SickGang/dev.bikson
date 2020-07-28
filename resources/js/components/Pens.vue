<template>
  <div class="goods-list d-flex flex-wrap mb-5 mt-5">

  <div v-for="item in response" class="goods-list_item col-lg-3 d-flex flex-column p-2">
    <div class="goods-list_item__img">
      <a href="#">
        <img :src="item.img_url" alt="">
      </a>
    </div>
    <div class="goods-list_item__info d-flex p-3 flex-column align-items-center">
      <div class="goods-list_item__info-left mr-3">
        <p>{{item.title}}</p>
        <span>{{item.price}} руб</span>
      </div>
      <div class="goods-list_item__info-right mt-3">
          <a @click="addToCart(item)" class="item-button" href="#">Купить</a>
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
        name: 'Ручки автоматические'
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
