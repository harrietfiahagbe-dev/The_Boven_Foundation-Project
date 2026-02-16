<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const tagline = ref('Igniting Minds, Transforming Communities');

onMounted(async () => {
  try {
    const { data } = await axios.get('/settings');
    if (data.tagline) tagline.value = data.tagline;
  } catch (_) {}
});

function scrollTo(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}
</script>

<template>
  <footer class="footer">
    <div class="footer-bg"></div>
    <div class="footer-inner">
      <div class="footer-brand">
        <strong>The Boven Foundation</strong>
        <p class="footer-tagline">{{ tagline }}</p>
      </div>
      <nav class="footer-links">
        <a href="#about" @click.prevent="scrollTo('about')">About Us</a>
        <a href="#mission" @click.prevent="scrollTo('mission')">Vision & Mission</a>
        <a href="#cta" @click.prevent="scrollTo('cta')">Donate</a>
        <a href="#contact" @click.prevent="scrollTo('contact')">Contact Us</a>
      </nav>
      <p class="footer-copy">© {{ new Date().getFullYear() }} The Boven Foundation. All Rights Reserved.</p>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  padding: 3rem 1.5rem;
  color: #fff;
  position: relative;
  overflow: hidden;
}
.footer-bg {
  position: absolute;
  inset: 0;
  background: linear-gradient(160deg, var(--color-body) 0%, var(--color-primary-dark) 100%);
}
.footer-inner {
  position: relative;
  z-index: 1;
  max-width: 1200px;
  margin: 0 auto;
  text-align: center;
}
.footer-brand strong {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  font-weight: 700;
  letter-spacing: -0.02em;
}
.footer-tagline {
  margin: 0.35rem 0 1.5rem;
  font-size: 0.9375rem;
  opacity: 0.9;
}
.footer-links {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 1.75rem;
  margin-bottom: 1.5rem;
}
.footer-links a {
  color: #fff;
  text-decoration: none;
  font-weight: 500;
  font-size: 0.9375rem;
  transition: opacity var(--duration-fast);
}
.footer-links a:hover { opacity: 0.85; }
.footer-copy { margin: 0; font-size: 0.875rem; opacity: 0.8; }
</style>
