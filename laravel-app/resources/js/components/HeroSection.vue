<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';
import { useSmoothScroll } from '../composables/useSmoothScroll';

const settings = ref({});
const currentSlide = ref(0);
const { scrollToElement } = useSmoothScroll();

const slides = [
  '/assets/img/picture.jpeg',
  '/assets/img/picture4.jpeg',
  '/assets/img/picture2.jpeg',
];

onMounted(async () => {
  try {
    const { data } = await axios.get('/settings');
    settings.value = data;
  } catch (_) {
    settings.value = {
      hero_headline: 'Empowering Communities Through Education and Action',
      hero_subtext: 'Closing the education gap with STEM resources, mentorship, and inclusive learning spaces for underserved youth.',
    };
  }
  
  // Auto-slide every 5 seconds
  const interval = setInterval(() => {
    currentSlide.value = (currentSlide.value + 1) % slides.length;
  }, 5000);
  
  onUnmounted(() => clearInterval(interval));
});

function scrollTo(id) {
  scrollToElement(`#${id}`, 80);
}

function goToSlide(index) {
  currentSlide.value = index;
}
</script>

<template>
  <section id="hero" class="hero">
    <div class="hero-bg">
      <div 
        v-for="(slide, index) in slides" 
        :key="index"
        class="hero-slide"
        :class="{ active: currentSlide === index }"
        :style="{ backgroundImage: `url(${slide})` }"
      ></div>
      <div class="hero-overlay"></div>
    </div>
    <div class="hero-content">
      <h1 class="hero-title">{{ settings.hero_headline || 'Empowering Communities Through Education and Action' }}</h1>
      <p class="hero-subtext">{{ settings.hero_subtext || 'Closing the education gap with STEM resources and inclusive learning spaces.' }}</p>
    </div>
    <div class="hero-slider-controls">
      <button
        v-for="(slide, index) in slides"
        :key="index"
        type="button"
        class="slider-dot"
        :class="{ active: currentSlide === index }"
        :aria-label="`Go to slide ${index + 1}`"
        @click="goToSlide(index)"
      ></button>
    </div>
    <div class="hero-scroll-hint" aria-hidden="true">
      <span>Scroll</span>
      <div class="scroll-line"></div>
    </div>
  </section>
</template>

<style scoped>
.hero {
  min-height: 100vh;
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  position: relative;
  overflow: hidden;
  padding-top: 22rem;
}
.hero-bg {
  position: absolute;
  inset: 0;
}
.hero-slide {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}
.hero-slide.active {
  opacity: 1;
}
.hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  z-index: 1;
}
.hero-content {
  position: relative;
  z-index: 2;
  text-align: left;
  padding: 2rem 3rem 4rem;
  max-width: 820px;
  margin-left: 0;
}
.hero-title {
  font-family: var(--font-heading);
  font-size: clamp(2.25rem, 5.5vw, 4rem);
  font-weight: 800;
  letter-spacing: -0.03em;
  line-height: 1.15;
  color: #fff;
  text-shadow: 0 2px 20px rgba(0, 0, 0, 0.4), 0 0 1px rgba(0, 0, 0, 0.5);
  margin: 0 0 1.25rem;
  opacity: 0;
  transform: translateY(24px);
  animation: fade-in-up 0.9s var(--ease-out-expo) 0.2s forwards;
}
.hero-subtext {
  font-size: clamp(1.125rem, 2.5vw, 1.5rem);
  font-weight: 600;
  color: rgba(255, 255, 255, 0.98);
  text-shadow: 0 1px 12px rgba(0, 0, 0, 0.35), 0 0 1px rgba(0, 0, 0, 0.4);
  margin: 0 0 2.25rem;
  line-height: 1.6;
  opacity: 0;
  transform: translateY(24px);
  animation: fade-in-up 0.9s var(--ease-out-expo) 0.35s forwards;
}
.hero-slider-controls {
  position: absolute;
  bottom: 4rem;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 0.75rem;
  z-index: 3;
}
.slider-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 2px solid rgba(255, 255, 255, 0.5);
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  padding: 0;
}
.slider-dot:hover {
  border-color: rgba(255, 255, 255, 0.8);
  transform: scale(1.2);
}
.slider-dot.active {
  background: rgba(255, 255, 255, 0.9);
  border-color: rgba(255, 255, 255, 0.9);
  width: 32px;
  border-radius: 6px;
}
.hero-scroll-hint {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  color: rgba(255, 255, 255, 0.7);
  font-size: 0.75rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
}
.scroll-line {
  width: 1px;
  height: 40px;
  background: linear-gradient(to bottom, rgba(255,255,255,0.6), transparent);
  border-radius: 2px;
  animation: float 2s var(--ease-out-quart) infinite;
}
@media (max-width: 768px) {
  .hero { 
    padding-top: 8rem;
    min-height: 90vh;
  }
  .hero-content { 
    padding: 1.5rem 1.25rem 3rem; 
    text-align: center; 
    max-width: 100%;
  }
  .hero { justify-content: center; }
  .hero-title {
    font-size: clamp(1.75rem, 6vw, 2.5rem);
    margin-bottom: 1rem;
  }
  .hero-subtext {
    font-size: clamp(1rem, 3vw, 1.125rem);
    margin-bottom: 1.5rem;
  }
  .hero-slider-controls {
    bottom: 2.5rem;
    gap: 0.5rem;
  }
  .slider-dot {
    width: 10px;
    height: 10px;
  }
  .slider-dot.active {
    width: 24px;
  }
  .hero-scroll-hint {
    bottom: 1rem;
    font-size: 0.6875rem;
  }
}
</style>
