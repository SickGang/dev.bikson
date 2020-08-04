<template>
  <div class="title-block text-center p-5" ref="anchor-2" id="anchor-2">
      <h1>Ежедневники</h1>
  <div v-for="(item, index) in response" v-if="index>2" class="">
    <diariesitemshead :item="item"></diariesitemshead>
  </div>
  <div class="goods-list d-flex flex-wrap">
    <div v-for="(item, index) in response" v-if="index<3" class="goods-list_item col-lg-6 d-flex flex-column p-md-5">
      <diariesitems :item="item"></diariesitems>
    </div>
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
