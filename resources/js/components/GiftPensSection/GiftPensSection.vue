<template>
  <div class="title-block text-center p-5" ref="anchor-3" id="anchor-3">
      <h1>Подарочные ручки</h1>
      <span>Элегантные ручки в подарочном брендированном футляре, с поворотным механизмом. Цвет чернил синий, толщина линии письма 0,5 мм. Выполнены в великолепном качестве с изящным дизайном.</span>
      <giftpensitemshead v-for="(item, index) in response" v-if="index<2" :item="item" :key="item.id"></giftpensitemshead>
    <div class="goods-list d-flex flex-wrap mb-5">
        <giftpensitems v-for="(item, index) in response" v-if="index>=2" :item="item" :key="item.id"></giftpensitems>
      </div>
    </div>
  </div>
</template>

<script>
import giftpensitemshead from './GiftPensItemsHead.vue'
import giftpensitems from './GiftPensItems.vue'

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
        name: 'Ручки подарочные'
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
  components: {giftpensitemshead,giftpensitems}
}
</script>
