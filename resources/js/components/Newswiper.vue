<template>
<div>
  <div class='slider js-slider'>
    <div class="slider__body" v-bind:style='{left: sliderOffsetLeft + "px"}'>
      <div class="slider__slide js-slide" v-for='slide in response' v-bind:style='"background-image: url(" + slide.url + ")"'></div>
    </div>
  </div>
  <span class="btnSlider" v-on:click="prevSlide">
    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
      <path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
    </svg>
  </span>
  <span class="btnSlider" v-on:click="nextSlide">
    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
      <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/>
    </svg>
  </span>
</div>
</template>

<script>
export default {
  props: ['itemId'],
  data() {
    return {
      response: '',
      // Всего слайдов
      sliderAllCount: 0,
      // Номер активного слайда
      sliderActive: 1,
      // Отступ тела со слайдами в контейнере
      sliderOffsetLeft: 0,
      // Шаг одного слайда = его длина
      sliderOffsetStep: 0,
    }
  },
  mounted() {
    this.getImage()
    // Перенастройка слайдера при ресайзе окна
    window.addEventListener('resize', () => {
      this.initSlider()
      this.openSlide(this.sliderActive)
    })
  },
  methods: {
    getImage: function () {
      axios.post('/getImages',{
        itemId: this.itemId
      })
      .then(response => {
        this.response = response.data
        this.initSlider()
      })
    },
    initSlider: function () {
			// Получаем элементы сладера и его слайдов
      let sliderBody = this.$el.querySelector('.js-slider')
			// Записываем длину одного слайда для перелистывания
      this.sliderOffsetStep = sliderBody.clientWidth
			// Общее количество слайдов для стопов
      this.sliderAllCount = this.response.length
    },

		// Открыть слайд по номеру
    openSlide: function (id) {
      if (id > 0 && id <= this.sliderAllCount) {
        this.sliderActive = id
				// Сдвигаем элемент со слайдами
        this.sliderOffsetLeft = -(this.sliderActive * this.sliderOffsetStep - this.sliderOffsetStep)
      }
    },

    // Следующий слайд
    nextSlide: function () {
      if (this.sliderActive < this.sliderAllCount) {
          this.sliderActive += 1
          this.openSlide(this.sliderActive)
      } else {
        this.sliderActive = 1
        this.openSlide(this.sliderActive)
      }
    },

    // Предыдущий слайд
    prevSlide: function () {
      if (this.sliderActive > 1) {
        this.sliderActive -= 1
				this.openSlide(this.sliderActive)
      }
    }
  }
}
</script>

<style lang="scss" scoped>

$slider-height: 400px;
$slide-width: 100%;

span {
  cursor: pointer;
}

.slider {
	width: 100%;
	height: $slider-height;
	position: relative;
	overflow: hidden;

	&__body {
		min-width: auto;
		height: $slider-height;
		display: flex;
		position: relative;
		align-items: stretch;
		transition: all .5s ease;
	}

	&__slide {
		min-width: $slide-width;
		height: $slider-height;
    background: no-repeat;
		background-size: contain;
		background-position: center;
		flex: 1 100%;
	}
}

.btnSlider {
  svg {
    border: 1px solid black;
    border-radius: 50%;
    &:hover {
      background-color: black;
      color: white;
      transition: .7s ease-out;
    }
  }
}

</style>
