import Vue from 'vue'
import VueScrollactive from 'vue-scrollactive'
import store from './store.js'
import VueRouter from 'vue-router'
import VueTippy, { TippyComponent } from "vue-tippy"

Vue.use(VueTippy, {
    directive: "tippy", // => v-tippy
    flipDuration: 0,
    popperOptions: {
        modifiers: {
            preventOverflow: {
                enabled: true
            }
        }
    }
})

Vue.component("tippy", TippyComponent)
import "tippy.js/themes/light.css"
import "tippy.js/themes/light-border.css"
import "tippy.js/themes/google.css"
import "tippy.js/themes/translucent.css"
Vue.use(VueRouter)
Vue.use(VueScrollactive)

require('./bootstrap')

import App from './App.vue'

const app = new Vue({
    el: '#app',
    components: {App},
    store: new Vuex.Store(store)
});
