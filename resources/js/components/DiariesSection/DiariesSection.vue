<template>
  <div class="title-block text-center p-5" ref="anchor-2" id="anchor-2">
      <h1>Ежедневники</h1>
      <diariesitemshead v-for="(item, index) in response" v-if="index<2" :item="item" :key="item.id"></diariesitemshead>
  <div class="goods-list d-flex flex-wrap">
      <diariesitems v-for="(item, index) in response" v-if="index>1" :item="item" :key="item.id"></diariesitems>
  </div>
</div>
</template>

<script>
import diariesitemshead from './DiariesItemsHead.vue'
import diariesitems from './DiariesItems.vue'

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
        name: 'Ежедневники А5'
      })
      .then(response => {
        this.response = response.data
      })
      .catch(function (error) {
        console.log(error)
      })
    }
  },
  components: {diariesitemshead,diariesitems}
}
</script>
