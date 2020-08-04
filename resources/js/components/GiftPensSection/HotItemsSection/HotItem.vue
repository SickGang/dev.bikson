<template>
<div class="item-section d-flex flex-column flex-md-row align-items-center p-md-5">
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
        <a @click="showPopup" class="item-button" href="#">Подробнее</a>
        <a @click="addToCart(item)" class="item-button" href="#">Купить</a>
      </div>
    </div>
  </div>
  <popup-info v-if="isPopupVisible">
    <div class="popup_title col-12">
      <span>{{item.title}}</span>
    </div>
    <div class="row">
      <div class="popup_image col-6">
        <img src="" alt="">
      </div>
      <div class="popup_info col-6">
        <div class="popup_info-price">
          <span>{{item.price}}</span>
        </div>
        <div class="popup_info-spec">
          <tbody><tr><td><span>Остаток:</span></td><td>4692 шт</td></tr>
          <tr><td><span>Размер:</span></td><td>15*1*1</td></tr>
          <tr><td><span>ИнвКод:</span></td><td>РучА200</td></tr>
          <tr><td><span>TM:</span></td><td><a href="/brands/5078/">Bikson</a></td></tr>
          <tr><td><span>Серия:</span></td><td><a href="/series/5558/">Ежедневники BIKSON</a></td></tr>
          <tr><td><span>Производитель:</span></td><td>--</td></tr>
          <tr><td><span>Норма упаковки:</span></td><td>14!/14*/2400</td></tr>
          <tr><td><span>Цвет чернил:</span></td><td>Синие</td></tr>
          <tr><td><span>Толщина линии:</span></td><td>0,5мм</td></tr>
          <tr><td><span>Штрихкод:</span></td><td>2002005923191</td></tr>
          <tr><td><span>Артикул:</span></td><td>BN0310</td></tr>
          <tr><td colspan="2">&nbsp;</td></tr>
          </tbody>
        </div>
        <div class="popup_info-btn mt-2">
          <a @click="closePopup" class="item-button" href="#">Закрыть</a>
          <a class="item-button" href="#">В корзину</a>
        </div>
      </div>
    </div>
  </popup-info>
</div>
</template>

<script>
import popupInfo from '../PopupInfo.vue'

export default {
  props: ['item'],
  data() {
    return {
      isPopupVisible: false
    }
  },
  methods: {
    addToCart(item) {
      event.preventDefault()
      this.$store.commit('addToCart', item)
    },
    showPopup() {
      event.preventDefault()
      this.isPopupVisible = true
    },
    closePopup() {
      event.preventDefault()
      this.isPopupVisible = false
    }
  },
  components: {popupInfo}
}
</script>

<style lang="css" scoped>
</style>
