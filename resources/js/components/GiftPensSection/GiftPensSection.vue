<template>
  <div class="title-block text-center p-5" ref="anchor-3" id="anchor-3">
      <h1>Подарочные ручки</h1>
      <span>Элегантные ручки в подарочном брендированном футляре, с поворотным механизмом. Цвет чернил синий, толщина линии письма 0,5 мм. Выполнены в великолепном качестве с изящным дизайном.</span>
    <div v-for="(item, index) in response" v-if="index<2" class="item-section d-flex flex-column flex-md-row align-items-center p-md-5">
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
    <div class="goods-list d-flex flex-wrap mb-5">
      <div v-for="(item, index) in response" v-if="index>=2" class="goods-list_item col-lg-6 d-flex flex-column p-md-5">
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
  }
}
</script>
