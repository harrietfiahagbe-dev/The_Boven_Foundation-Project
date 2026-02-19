<script setup>
import { inject } from 'vue';
import { useInView } from '../composables/useInView';
import { useSmoothScroll } from '../composables/useSmoothScroll';

const openDonateModal = inject('openDonateModal', () => {});
const { targetRef, inView } = useInView();
const { scrollToElement } = useSmoothScroll();

function scrollTo(id) {
  scrollToElement(`#${id}`, 80);
}

function goToDonate() {
  openDonateModal();
}
</script>

<template>
  <section id="cta" ref="targetRef" class="cta">
    <div class="cta-bg"></div>
    <div class="cta-inner" :class="{ 'in-view': inView }">
      <h2 class="cta-title reveal reveal-delay-1">DONATE</h2>
      <p class="cta-text reveal reveal-delay-2">Your support helps us bring STEM education to more communities. Donate today to create lasting change for underserved youth.</p>
      <div class="cta-buttons reveal reveal-delay-3">
        <button type="button" class="btn btn-accent" @click="goToDonate">Donate Now</button>
      </div>
    </div>
  </section>
</template>

<style scoped>
.cta {
  padding: 5rem 1.5rem;
  color: #1a1f1a;
  position: relative;
  overflow: hidden;
}
.cta-bg {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-light) 50%, var(--color-accent-dark) 100%);
  background-size: 200% 200%;
  animation: gradient-shift 8s ease infinite;
}
.cta-inner {
  position: relative;
  z-index: 1;
  max-width: 700px;
  margin: 0 auto;
  text-align: center;
}
.cta-inner :deep(.reveal) {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s var(--ease-out-expo), transform 0.6s var(--ease-out-expo);
}
.cta-inner.in-view :deep(.reveal) {
  opacity: 1;
  transform: translateY(0);
}
.cta-inner :deep(.reveal-delay-1) { transition-delay: 0.05s; }
.cta-inner :deep(.reveal-delay-2) { transition-delay: 0.15s; }
.cta-inner :deep(.reveal-delay-3) { transition-delay: 0.25s; }
.cta-title {
  font-family: var(--font-heading);
  font-size: clamp(1.75rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  margin: 0 0 1rem;
}
.cta-text {
  margin: 0 0 2rem;
  line-height: 1.65;
  font-size: 1.125rem;
  font-weight: 500;
}
.cta-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}
.btn {
  padding: 0.875rem 1.75rem;
  border-radius: 12px;
  font-weight: 600;
  font-size: 1rem;
  font-family: var(--font-sans);
  text-decoration: none;
  border: 2px solid #1a1f1a;
  background: transparent;
  color: #1a1f1a;
  cursor: pointer;
  transition: transform var(--duration-fast), box-shadow var(--duration-normal), background var(--duration-fast), color var(--duration-fast);
}
.btn-accent {
  background: #1a1f1a;
  color: var(--color-accent);
  border-color: #1a1f1a;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}
.btn-accent:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 28px rgba(0, 0, 0, 0.25);
}
.btn-outline:hover {
  background: #1a1f1a;
  color: var(--color-accent);
  transform: translateY(-2px);
}
@media (max-width: 768px) {
  .cta { padding: 3rem 1.25rem; }
  .cta-title { font-size: 1.5rem; }
  .cta-text {
    font-size: 1rem;
    margin-bottom: 1.5rem;
  }
  .cta-buttons {
    flex-direction: column;
    align-items: stretch;
    gap: 0.875rem;
  }
  .btn {
    width: 100%;
    padding: 0.75rem 1.25rem;
    font-size: 0.9375rem;
  }
}
</style>
