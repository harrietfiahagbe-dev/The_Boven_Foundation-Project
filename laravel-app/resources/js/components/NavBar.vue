<script setup>
import { ref, onMounted, onUnmounted, inject } from 'vue';
import { useSmoothScroll } from '../composables/useSmoothScroll';

const openDonateModal = inject('openDonateModal', () => {});
const menuOpen = ref(false);
const scrolled = ref(false);
const { scrollToElement } = useSmoothScroll();

function scrollTo(id) {
  scrollToElement(`#${id}`, 80);
  menuOpen.value = false;
}

function goToDonate() {
  openDonateModal();
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
      <ul class="nav-links nav-links-left">
        <li><a href="#about" @click.prevent="scrollTo('about')">About Us</a></li>
        <li><a href="#mission" @click.prevent="scrollTo('mission')">Vision & Mission</a></li>
      </ul>
      <a href="#" class="logo" @click.prevent="scrollTo('hero')">
        <img src="/assets/img/logo.jpeg" alt="The Boven Foundation" class="logo-img" />
        <span>The Boven Foundation</span>
      </a>
      <ul class="nav-links nav-links-right">
        <li><a href="#contact" @click.prevent="scrollTo('contact')">Contact Us</a></li>
        <li><a href="#donate" class="btn-donate" @click.prevent="goToDonate">Donate</a></li>
      </ul>
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
      <ul class="nav-links nav-links-mobile" :class="{ open: menuOpen }">
        <li><a href="#about" @click.prevent="scrollTo('about')">About Us</a></li>
        <li><a href="#mission" @click.prevent="scrollTo('mission')">Vision & Mission</a></li>
        <li><a href="#contact" @click.prevent="scrollTo('contact')">Contact Us</a></li>
        <li><a href="#donate" class="btn-donate" @click.prevent="goToDonate">Donate</a></li>
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
  max-width: 1400px;
  margin: 0 auto;
  padding: 0.875rem 1.5rem;
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  align-items: center;
  gap: 2rem;
  position: relative;
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
  justify-self: center;
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
.nav-links-left {
  justify-self: start;
}
.nav-links-right {
  justify-self: end;
}
.nav-links-mobile {
  display: none;
}
.btn-donate {
  background: transparent !important;
  color: var(--color-primary) !important;
  padding: 0.5rem 1.25rem !important;
  border-radius: 8px !important;
  font-weight: 600 !important;
  border: 2px solid var(--color-primary) !important;
  transition: all var(--duration-fast) !important;
}
.btn-donate:hover {
  background: var(--color-primary) !important;
  color: #fff !important;
  transform: translateY(-1px);
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
.nav-links a.btn-donate::after {
  display: none;
}
.nav-links a:hover { color: var(--color-primary); }
.nav-links a:hover::after { width: 100%; }
.nav-links a.btn-donate:hover::after {
  display: none;
}
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
@media (max-width: 968px) {
  .navbar-inner {
    grid-template-columns: 1fr auto;
    padding: 0.875rem 1.25rem;
    gap: 1rem;
  }
  .nav-links-left,
  .nav-links-right {
    display: none;
  }
  .nav-links-mobile {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    flex-direction: column;
    gap: 0;
    background: #fff;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    padding: 0;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    border-radius: 0 0 12px 12px;
    border-top: 1px solid var(--color-border);
    overflow: hidden;
    z-index: 1000;
  }
  .nav-links-mobile.open {
    display: flex;
  }
  .nav-links-mobile li {
    border-bottom: 1px solid var(--color-border);
  }
  .nav-links-mobile li:last-child {
    border-bottom: none;
  }
  .nav-links-mobile a {
    display: block;
    padding: 1rem 1.25rem;
    color: var(--color-body);
    text-decoration: none;
    font-size: 0.9375rem;
    font-weight: 500;
    transition: background var(--duration-fast), color var(--duration-fast);
    width: 100%;
  }
  .nav-links-mobile a:hover {
    background: var(--color-bg-alt);
    color: var(--color-primary);
  }
  .nav-links-mobile .btn-donate {
    background: var(--color-primary) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 1rem 1.25rem !important;
    font-weight: 600 !important;
    margin: 0.5rem 1.25rem;
    text-align: left;
    display: block;
    width: calc(100% - 2.5rem);
  }
  .nav-links-mobile .btn-donate:hover {
    background: var(--color-primary-dark) !important;
    color: #fff !important;
  }
  .logo {
    justify-self: start;
  }
  .logo span {
    display: inline;
    font-size: 1rem;
  }
  .logo-img {
    height: 36px;
  }
  .hamburger {
    display: flex;
    justify-self: end;
  }
}
@media (max-width: 480px) {
  .navbar-inner {
    padding: 0.75rem 1rem;
  }
  .logo {
    gap: 0.5rem;
  }
  .logo span {
    font-size: 0.875rem;
  }
  .logo-img {
    height: 32px;
  }
  .hamburger {
    width: 36px;
    height: 36px;
  }
  .hamburger span {
    width: 20px;
  }
  .nav-links-mobile a {
    padding: 0.875rem 1rem;
    font-size: 0.875rem;
  }
}
</style>
