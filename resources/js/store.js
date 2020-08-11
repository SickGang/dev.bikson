let cart = window.localStorage.getItem('cart')
let cartCount = window.localStorage.getItem('cartCount')

let store = {
  state: {
      cart: cart ? JSON.parse(cart) : [],
      cartCount: cartCount ? parseInt(cartCount) : 0,
      isAddItemVisible: false
  },
  mutations: {
    addToCart(state, item) {
      let found = state.cart.find(product => product.id == item.id)
       if (found) {
           found.quantity ++
           found.totalPrice = found.quantity * found.price
       } else {
           state.cart.push(item)

           Vue.set(item, 'quantity', 1)
           Vue.set(item, 'totalPrice', item.price)
       }

       state.cartCount++
       this.commit('saveCart')
    },
    removeFromBasket(state, item) {
      let index = state.cart.indexOf(item)
      console.log(cartCount)
      if (index > -1) {
          let product = state.cart[index]
          state.cartCount -= product.quantity

          state.cart.splice(index, 1)
      }
      this.commit('saveCart')
    },
    increment(state, index) {
      state.cart[index].quantity++
      state.cartCount++
      state.cart[index].totalPrice = state.cart[index].quantity * state.cart[index].price
      this.commit('saveCart')
    },
    decrement(state, index) {
      if (state.cart[index].quantity > 1) {
        state.cart[index].quantity--
        state.cartCount--
        state.cart[index].totalPrice -= state.cart[index].price
      }
    },
    saveCart(state, saveCart) {
      if (saveCart == 1) {
        window.localStorage.setItem('cart', [])
        window.localStorage.setItem('cartCount', 0)
      } else {
        window.localStorage.setItem('cart', JSON.stringify(state.cart))
        window.localStorage.setItem('cartCount', state.cartCount)
      }
    },
    changeAddItem: (state) => {
      state.isAddItemVisible = !state.isAddItemVisible
    }
  },
  actions: {
    INCREMENT_CART_ITEM({commit}, index) {
      commit('increment', index)
    },
    DECREMENT_CART_ITEM({commit}, index) {
      commit('decrement', index)
    },
    TOGGLE_ADD_ITEM({commit}) {
      commit('changeAddItem')
    }
  },
  getters: {
    SHOW_ADD_ITEM(state) {
      return state.isAddItemVisible
    }
  }
};

export default store
