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
