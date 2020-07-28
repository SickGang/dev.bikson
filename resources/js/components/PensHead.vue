<template>
  <div class="title-block text-center p-5" ref="anchor-4" id="anchor-3">
    <h1>Ручки</h1>
    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>

<div class="d-flex">
  <div v-for="(item, index) in response" v-if="index<2" class="goods-list_item col-lg-6 d-flex flex-column p-2">
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

  <pens></pens>
</div>
</template>

<script>
import pens from './Pens.vue'
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
  },
  components: {pens}
}
</script>
