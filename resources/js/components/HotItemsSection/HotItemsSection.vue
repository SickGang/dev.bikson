<template>
  <div class="title-block text-center p-5" ref="anchor-1" id="anchor-1">
    <h1>Горячие новинки</h1>
    <hotitem v-for="item in response" :item="item" :key="item.id"></hotitem>
  </div>
</div>
</template>

<script>
  import hotitem from './HotItem.vue'

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
    }
  },
  components: {hotitem}
}
</script>
