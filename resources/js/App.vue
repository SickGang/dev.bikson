<template>
<div id="app">
  <header class="header">
    <div class="header-logo mt-3">
    </div>
  </header>
  <scrollactive class="my-nav p-2 p-md-4" active-class="active" :offset="50" :duration="800" bezier-easing-value=".5,0,.35,1">
    <div class="d-flex d-md-none align-items-center">
      <div @click="clickMenu()" v-bind:class="{ 'active' : active }" class="tpl_hamburger" id="sandwichmenu">
        <svg viewBox="0 0 800 600">
          <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" class="top"></path>
          <path d="M300,320 L540,320" class="middle"></path>
          <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
        </svg>
      </div>
    </div>
    <transition :duration="{ enter: 500, leave: 800 }">
      <ul v-bind:class="{ 'is-active' : active }" class="nav-list list-unstyled d-none d-md-flex justify-content-around flex-column flex-md-row align-items-center m-0">
        <li v-for="(item, i) in items">
          <a @click="fixHref($event)" :href="'#'+'anchor-'+i" class="scrollactive-item"> {{item}} </a>
        </li>
      </ul>
    </transition>
  </scrollactive>

  <aboutbrand></aboutbrand>
  <hotitems></hotitems>
  <diaries></diaries>
  <giftpens></giftpens>
  <pens></pens>

  <div class="btn-basket">
    <a href="#" class="cd-cart-trigger" @click="showBasket()">
    </a>
    <div>{{ $store.state.cartCount }}</div>
  </div>
  <basket v-show="SHOW_ADD_ITEM" @updateParent="showBasketEnd"></basket>
  <backtotop></backtotop>
  <basketend v-if="baskState" @closeBasket="closeBasketEnd"></basketend>
</div>

</template>

<script>
import {mapGetters} from 'vuex'
import hotitems from './components/HotItemsSection/HotItemsSection.vue'
import diaries from './components/DiariesSection/DiariesSection.vue'
import giftpens from './components/GiftPensSection/GiftPensSection.vue'
import pens from './components/PensSection/PensSection.vue'
import basket from './components/Basket.vue'
import backtotop from './components/BackToTop.vue'
import basketend from './components/BasketEnd.vue'
import aboutbrand from './components/AboutBrand.vue'


export default {
  data() {
    return {
        items: [
          'О бренде',
          'Горячие новинки',
          'Ежедневники',
          'Подарочные ручки',
          'Ручки'
        ],
        showModalBasket: false,
        active: false,
        baskState: false
    }
  },
  computed: {
    ...mapGetters([
      'SHOW_ADD_ITEM'
    ])
  },
  methods: {
    showBasketEnd() {
      this.baskState = !this.baskState
    },
    closeBasketEnd() {
      event.preventDefault()
      this.baskState = false
      window.location.href = '/'
    },
    showBasket: function () {
      event.preventDefault()
      document.body.style.overflow = 'hidden'
      this.$store.dispatch('TOGGLE_ADD_ITEM')
    },
    clickMenu: function() {
      this.active = !this.active
    },
    fixHref: function(event) {
      setTimeout(() => history.pushState(null,null,' '), 845)
    }
  },
  components: {hotitems, diaries, giftpens, pens, basket, backtotop, basketend,aboutbrand}
}
</script>
