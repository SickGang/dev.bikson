<template>
    <div class="popup-wrapper">
        <div class="popup">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
    }
</script>

<style scoped>
.modal-fade-enter,
 .modal-fade-leave-active {
   opacity: 0;
 }

 .modal-fade-enter-active,
 .modal-fade-leave-active {
   transition: opacity .5s ease
 }
</style>
