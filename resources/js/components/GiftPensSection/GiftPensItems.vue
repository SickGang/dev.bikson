<template>
  <div class="goods-list_item col-lg-6 d-flex flex-column p-md-5">
    <div class="goods-list_item__img">
      <a href="#">
        <img @click="showPopup" :src="item.img_url" alt="">
      </a>
    </div>
    <div class="goods-list_item__info d-flex p-3 flex-column align-items-center">
      <div class="goods-list_item__info-left mr-3">
        <p>{{item.title}}</p>
        <span>{{item.price}} руб</span>
      </div>
      <div class="goods-list_item__info-right mt-3 d-flex">
        <tippy class="mb-2" trigger="click" theme="light" interactive="true" zIndex="3" size="large" arrow="true" :duration="[600,600]" :delay="[400,0]">
          <template v-slot:trigger>
            <button @click="addToCart(item)" class="item-button">
              Купить
            </button>
          </template>
          <div class="mb-3">Товар добавлен в корзину</div>
          <a @click="showBasket" class="item-button item-button_mod" href="#">В корзину</a>
        </tippy>
        <button @click="showPopup" class="item-button item-button_mod" >Подробнее</button>
      </div>
    </div>
    <transition name="modal-fade">
      <popup-info v-if="isPopupVisible">
        <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close" @click="closePopup"><span aria-hidden="true">&times;</span></button>
        <div class="popup_title font-weight-bold col-12 font mb-2">
          <h3>{{item.title}}</h3>
        </div>
        <div class="popup_info-wrap row">
          <div class="popup_image col-12 col-md-6">
            <newswiper :itemId="item.id"></newswiper>
          </div>
          <div class="popup_info col-12 col-md-4">
            <div class="popup_info-spec">
              <tbody>
                <tr><td><span>Стоимость:</span></td><td><span class="font-weight-bold">{{item.price}} руб.</span></td></tr>
              </tbody>
              <div class="text-left" v-html="item.description">
              </div>
            </div>
            <div class="popup_info-btn mt-2">
              <a @click="closePopup" class="item-button" href="#">Закрыть</a>
              <a @click="addToCart(item)" class="item-button" href="#">В корзину</a>
            </div>
          </div>
        </div>
      </popup-info>
    </transition>
  </div>
</template>

<script>
import popupInfo from '../PopupInfo.vue'
import newswiper from '../Newswiper.vue'
import tooltip from '../Tooltip.vue'
import {mapGetters} from 'vuex'

export default {
  props: ['item'],
  data() {
    return {
      isPopupVisible: false
    }
  },
  computed: {
    ...mapGetters([
      'SHOW_ADD_ITEM'
    ])
  },
  methods: {
    addToCart(item) {
      event.preventDefault()
      setTimeout(() => {
        this.$children[0].tip.hide()
      }, 3000)
      this.isPopupVisible = false
      this.$store.commit('addToCart', item)
    },
    showBasket() {
      event.preventDefault()
      this.$store.dispatch('TOGGLE_ADD_ITEM')
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
  components: {popupInfo,newswiper, tooltip}
}
</script>

<style lang="css" scoped>
</style>
