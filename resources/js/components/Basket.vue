<template>
<transition name="modal-fade">
  <div class="basket-wrapper">
    <div class="basket d-flex flex-column p-4" v-on:closeBasket="$emit('close')">
<!--    <div class="basket-close align-self-end">-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeBasket"><span aria-hidden="true">&times;</span></button>-->
<!--    </div>-->
    <div class="">
      <div class="basket-list">
        <div class="basket-list_head row justify-content-between">
          <div><h3 class="font-weight-bold">Корзина ({{ $store.state.cartCount }}) </h3></div>
          <div class="basket-list_head__btn"><button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeBasket"><span aria-hidden="true">&times;</span></button></div>
        </div>
        <div class="basket-list_items">
          <div v-for="(item, index) in $store.state.cart" :key="item.id" v-if="$store.state.cart.length > 0" class="basket-list_item-wrap row mb-2 align-items-lg-center">
            <div class="basket-list_item__img col-lg-3 col-3">
              <img :src="item.img_url" alt="">
            </div>
            <div class="basket-list_item__descr col-lg-8 col-7">
              <div class="row align-items-center">
                <div class="col-12 col-lg-5">
                  <p>{{item.title}}</p>
                </div>
                <div class="basket-list_item__count col-lg-2 col-6 text-center">
                    <span @click="decrement(index)" class="basket-list_item__btn">-</span>
                    <span>{{item.quantity}}</span>
                    <span @click="increment(index)" class="basket-list_item__btn">+</span>
                </div>
                <div class="basket-list_item__price col-lg-3 col text-center">
                  <span>{{item.price}} ₽</span>
                </div>
              </div>
            </div>
              <div class="basket-list_item__del-btn col-md-1 col">
                <button @click.prevent="removeFromBasket(item)" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
          </div>
          <div v-else class="basket-list__unknown">
            <p>Корзина пуста</p>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-4">
      <span class="font-weight-bold">Итого: {{ totalPrice }} ₽</span>
    </div>
    <div class="mt-2">
      <div class="basket-info">
        <div class="basket-info_head">
          <h3 class="font-weight-bold">Получатель</h3>
        </div>
        <div v-if="errors.length" class="">
          <b>Пожалуйста исправьте указанные ошибки:</b>
          <ul>
            <li v-for="error in errors">{{ error }}</li>
          </ul>
        </div>
        <div class="col-lg-12 p-0">
          <div class="form-group">
            <label class="font-weight-bold" for="">Имя Фамилия</label>
            <input type="text" id="name" placeholder="Иванов Иван" v-model="name" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-lg-6">
            <label class="font-weight-bold" for="">E-mail</label>
            <input type="email" id="email" placeholder="my@mail.ru" v-model="email" class="form-control">
          </div>
          <div class="form-group col-lg-6">
            <label class="font-weight-bold" for="">Телефон</label>
            <input type="tel" id="phone" placeholder="+7 800 800 80 80" v-model="phone" class="form-control">
          </div>
        </div>
        <div class="col-lg-12 p-0">
          <label class="font-weight-bold" for="">Город</label>
          <input type="text" id="cityName" placeholder="Саратов" v-model="city" class="form-control">
        </div>
      </div>
    </div>
    <div class="row mt-5 justify-content-center">
      <div class="basket-btn">
        <a href="#" class="item-button p-2" @click="sendMail">Оформить заказ</a>
      </div>
    </div>
  </div>

</div>
</transition>

</template>

<script>
import {mapActions} from 'vuex'
import {mapGetters} from 'vuex'

export default {
  props: ['baskState'],
  data() {
    return {
      name: '',
      email: '',
      phone: '',
      city: '',
      errors: [],
      saveCart: 1
    }
  },
  methods: {
    ...mapActions([
      'INCREMENT_CART_ITEM',
      'DECREMENT_CART_ITEM'
    ]),
    sendMail: function() {
      event.preventDefault()
      if (this.name && this.email && this.phone && this.city) {
        this.$emit('updateParent')
        this.$emit('close')
        axios.post('/submit', {
          name: this.name,
          email: this.email,
          phone: this.phone,
          city: this.city,
          totalPrice: this.totalPrice,
          cart: JSON.stringify(this.$store.state.cart)
        })
        .then(function (response) {
          console.log('Ok!')
        })
        .catch(function (error) {
          console.log('Error!')
        })

        this.name = '',
        this.email = '',
        this.phone = '',
        this.city = '',
        this.errors = ''
        this.$store.commit('saveCart', this.saveCart)
      } else {
        this.errors = []

        if (!this.name) {
          this.errors.push('Требуется указать имя.')
        }

        if (!this.email) {
          this.errors.push('Требуется указать почту.')
        }

        if (!this.email) {
          this.errors.push('Требуется указать телефон.')
        }
        if (!this.email) {
          this.errors.push('Требуется указать город.')
        }
      }

    },
    removeFromBasket(item) {
      this.$store.commit('removeFromBasket', item)
    },
    increment(index) {
      this.INCREMENT_CART_ITEM(index)
    },
    decrement(index) {
      this.DECREMENT_CART_ITEM(index)
    },
    closeBasket() {
      document.body.style.overflow = 'visible'
      this.$store.dispatch('TOGGLE_ADD_ITEM')
    }
  },
  computed: {
    ...mapGetters([
      'SHOW_ADD_ITEM'
    ]),
    totalPrice() {
      let total = 0

      for (let item of this.$store.state.cart) {
        total += parseFloat(item.totalPrice)
      }

      return total.toFixed(2)
    }
  }
}
</script>

<style>
.modal-fade-enter,
 .modal-fade-leave-active {
   opacity: 0;
 }

 .modal-fade-enter-active,
 .modal-fade-leave-active {
   transition: opacity .5s ease
 }

 body.basket {
   overflow: hidden;
 }
</style>
