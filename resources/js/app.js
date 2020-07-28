/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import VueScrollactive from 'vue-scrollactive'
import store from './store.js'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

Vue.use(VueScrollactive)

require('./bootstrap')

import App from './App.vue'

const app = new Vue({
    el: '#app',
    components: {App},
    store: new Vuex.Store(store)
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// const app = new Vue({
//     el: '#app',
//     data() {
//       return {
//           items: [
//             'Горячие новинки',
//             'Ежедневники',
//             'Подарочные ручки',
//             'Ручки'
//           ],
//           showModalBasket: false,
//           active: false
//       }
//     },
//     methods: {
//       showBasket: function () {
//         event.preventDefault()
//         this.showModalBasket = true
//       },
//         clickMenu: function() {
//         this.active = !this.active
//       }
//     },
//     components: {hotitems, diarieshead, diaries},
//     store: new Vuex.Store(store)
// });
