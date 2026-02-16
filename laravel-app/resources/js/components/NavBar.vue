<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const menuOpen = ref(false);
const scrolled = ref(false);

function scrollTo(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
  menuOpen.value = false;
}

onMounted(() => {
  const onScroll = () => { scrolled.value = window.scrollY > 24; };
  window.addEventListener('scroll', onScroll, { passive: true });
  onUnmounted(() => window.removeEventListener('scroll', onScroll));
});
</script>

<template>
  <nav class="navbar" :class="{ scrolled }">
    <div class="navbar-inner">
      <a href="#" class="logo" @click.prevent="scrollTo('hero')">
        <img src="/assets/img/logo.jpeg" alt="The Boven Foundation" class="logo-img" />
        <span>The Boven Foundation</span>
      </a>
      <button
        type="button"
        class="hamburger"
        :class="{ open: menuOpen }"
        aria-label="Toggle menu"
        :aria-expanded="menuOpen"
        @click="menuOpen = !menuOpen"
      >
        <span></span>
        <span></span>
        <span></span>
      </button>
      <ul class="nav-links" :class="{ open: menuOpen }">
        <li><a href="#about" @click.prevent="scrollTo('about')">About Us</a></li>
        <li><a href="#mission" @click.prevent="scrollTo('mission')">Vision & Mission</a></li>
        <li><a href="#contact" @click.prevent="scrollTo('contact')">Contact Us</a></li>
        <li><a href="#cta" @click.prevent="scrollTo('cta')">Donate</a></li>
      </ul>
    </div>
  </nav>
</template>

<style scoped>
.navbar {
  position: sticky;
  top: 0;
  z-index: 100;
  background: #fff;
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border-bottom: 1px solid var(--color-border);
  transition:
    box-shadow var(--duration-normal) var(--ease-out-quart),
    border-color var(--duration-normal);
}
.navbar.scrolled {
  box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
}
.navbar-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0.875rem 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.logo {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 1.25rem;
  letter-spacing: -0.02em;
  color: var(--color-primary);
  text-decoration: none;
  transition: color var(--duration-fast);
}
.logo:hover { color: var(--color-primary-dark); }
.logo-img {
  height: 40px;
  width: auto;
  object-fit: contain;
  display: block;
}
.nav-links {
  display: flex;
  align-items: center;
  gap: 2rem;
  list-style: none;
  margin: 0;
  padding: 0;
}
.nav-links a {
  color: var(--color-body);
  text-decoration: none;
  font-size: 0.9375rem;
  font-weight: 500;
  position: relative;
  padding: 0.25rem 0;
  transition: color var(--duration-fast);
}
.nav-links a::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 0;
  height: 2px;
  background: var(--color-primary);
  transition: width var(--duration-normal) var(--ease-out-quart);
}
.nav-links a:hover { color: var(--color-primary); }
.nav-links a:hover::after { width: 100%; }
.hamburger {
  display: none;
  flex-direction: column;
  justify-content: center;
  gap: 6px;
  width: 40px;
  height: 40px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  border-radius: 10px;
  transition: background var(--duration-fast);
}
.hamburger:hover { background: var(--color-bg-alt); }
.hamburger span {
  display: block;
  width: 22px;
  height: 2px;
  background: var(--color-body);
  border-radius: 2px;
  transition:
    transform var(--duration-normal) var(--ease-out-quart),
    opacity var(--duration-fast);
}
.hamburger.open span:nth-child(1) {
  transform: translateY(8px) rotate(45deg);
}
.hamburger.open span:nth-child(2) {
  opacity: 0;
}
.hamburger.open span:nth-child(3) {
  transform: translateY(-8px) rotate(-45deg);
}
@media (max-width: 768px) {
  .hamburger { display: flex; }
  .nav-links {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    flex-direction: column;
    gap: 0;
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(14px);
    padding: 1rem;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
    display: none;
    border-radius: 0 0 16px 16px;
    animation: fade-in 0.3s var(--ease-out-quart);
  }
  .nav-links.open { display: flex; }
  .nav-links a { padding: 0.75rem 1rem; }
  .nav-links { background: #fff; }
}
</style>
