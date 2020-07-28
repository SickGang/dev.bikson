<template>
  <div class="basket-end_wrapp">
    <div class="basket-end">

    <!-- <div class=""> -->
      <div class="basket-end_text">
        <h1>Спасибо за заказ!</h1>
      </div>
    <!-- </div> -->

      <div class="basket-end_button">
        <a href="#" class="item-button p-2" @click="$emit('closeBasket')">Закрыть</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['baskState']
}
</script>
