<template>
<div class="title-block text-center p-5" ref="anchor-4" id="anchor-4">
    <h1>Ручки</h1>
    <span>Автоматические ручки с  матовым корпусом  Soft Tauch. Ручки разработаны  в  идентичной цветовой палитре к ежедневникам. Цвет чернил синий.</span>
  <div class="d-flex flex-wrap">
      <pensitemhead v-for="(item, index) in response" v-if="index<2" :item="item" :key="item.id"></pensitemhead>
  </div>
  <div class="goods-list d-flex flex-wrap mb-5 mt-5">
      <pensitem v-for="item in response" :item="item" :key="item.id"></pensitem>
  </div>
  </div>
</div>
</template>

<script>
import pensitemhead from './PensItemsHead.vue'
import pensitem from './PensItems.vue'

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
    }
  },
  components: {pensitemhead,pensitem}
}
</script>
