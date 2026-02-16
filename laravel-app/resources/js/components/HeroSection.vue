<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const settings = ref({});

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
});

function scrollTo(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}
</script>

<template>
  <section id="hero" class="hero">
    <div class="hero-bg">
      <div class="hero-gradient"></div>
      <div class="hero-image"></div>
    </div>
    <div class="hero-content">
      <h1 class="hero-title">{{ settings.hero_headline || 'Empowering Communities Through Education and Action' }}</h1>
      <p class="hero-subtext">{{ settings.hero_subtext || 'Closing the education gap with STEM resources and inclusive learning spaces.' }}</p>
      <div class="hero-buttons">
        <button type="button" class="btn btn-primary" @click="scrollTo('about')">About Us</button>
        <button type="button" class="btn btn-accent" @click="scrollTo('cta')">Donate</button>
        <button type="button" class="btn btn-outline" @click="scrollTo('contact')">Contact Us</button>
      </div>
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
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}
.hero-bg {
  position: absolute;
  inset: 0;
}
.hero-image {
  position: absolute;
  inset: 0;
  background: url('/assets/img/picture.jpeg') no-repeat center/cover;
}
.hero-gradient {
  position: absolute;
  inset: 0;
  background:
    linear-gradient(135deg, rgba(13, 92, 26, 0.88) 0%, rgba(8, 64, 18, 0.9) 50%, rgba(13, 92, 26, 0.85) 100%);
  background-size: 200% 200%;
  animation: gradient-shift 12s ease infinite;
}
.hero-content {
  position: relative;
  z-index: 1;
  text-align: center;
  padding: 2rem 1.5rem 4rem;
  max-width: 820px;
}
.hero-title {
  font-family: var(--font-heading);
  font-size: clamp(1.875rem, 4.5vw, 3.25rem);
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
  font-size: clamp(1rem, 2vw, 1.25rem);
  font-weight: 600;
  color: rgba(255, 255, 255, 0.98);
  text-shadow: 0 1px 12px rgba(0, 0, 0, 0.35), 0 0 1px rgba(0, 0, 0, 0.4);
  margin: 0 0 2.25rem;
  line-height: 1.6;
  opacity: 0;
  transform: translateY(24px);
  animation: fade-in-up 0.9s var(--ease-out-expo) 0.35s forwards;
}
.hero-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
  opacity: 0;
  transform: translateY(24px);
  animation: fade-in-up 0.9s var(--ease-out-expo) 0.5s forwards;
}
.btn {
  padding: 0.875rem 1.75rem;
  border-radius: 12px;
  font-weight: 600;
  font-size: 1rem;
  font-family: var(--font-sans);
  border: none;
  cursor: pointer;
  transition: transform var(--duration-fast), box-shadow var(--duration-normal);
}
.btn-primary {
  background: #fff;
  color: var(--color-primary);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}
.btn-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 28px rgba(0, 0, 0, 0.2);
}
.btn-accent {
  background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-dark) 100%);
  color: #1a1f1a;
  box-shadow: 0 4px 20px rgba(232, 163, 23, 0.4);
}
.btn-accent:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 28px rgba(232, 163, 23, 0.5);
}
.btn-outline {
  background: transparent;
  color: #fff;
  border: 2px solid rgba(255, 255, 255, 0.85);
}
.btn-outline:hover {
  background: rgba(255, 255, 255, 0.12);
  transform: translateY(-2px);
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
  .hero-buttons { flex-direction: column; align-items: center; }
  .btn { width: 100%; max-width: 280px; }
}
</style>
