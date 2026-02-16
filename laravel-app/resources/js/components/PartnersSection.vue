<script setup>
import { useInView } from '../composables/useInView';

const { targetRef, inView } = useInView();
</script>

<template>
  <section class="partners" ref="targetRef">
    <div class="partners-inner" :class="{ 'in-view': inView }">
      <h2 class="section-title reveal reveal-delay-1">Partners & Supporters</h2>
      <p class="partners-text reveal reveal-delay-2">
        We work with schools, community leaders, and organizations to maximize our impact. Interested in partnering?
        <a href="#contact" @click.prevent="document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' })">Get in touch</a>.
      </p>
    </div>
  </section>
</template>

<style scoped>
.partners {
  padding: 5rem 1.5rem;
  background: var(--color-surface);
}
.partners-inner {
  max-width: 1200px;
  margin: 0 auto;
  text-align: center;
}
.partners-inner :deep(.reveal) {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.55s var(--ease-out-expo), transform 0.55s var(--ease-out-expo);
}
.partners-inner.in-view :deep(.reveal) {
  opacity: 1;
  transform: translateY(0);
}
.partners-inner :deep(.reveal-delay-1) { transition-delay: 0.05s; }
.partners-inner :deep(.reveal-delay-2) { transition-delay: 0.15s; }
.section-title {
  font-family: var(--font-heading);
  font-size: clamp(1.75rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  color: var(--color-primary);
  margin: 0 0 1rem;
}
.partners-text {
  color: var(--color-body-muted);
  line-height: 1.7;
  margin: 0;
  font-size: 1.0625rem;
  max-width: 640px;
  margin-left: auto;
  margin-right: auto;
}
.partners-text a {
  color: var(--color-primary);
  font-weight: 600;
  text-decoration: none;
  transition: color var(--duration-fast);
}
.partners-text a:hover { color: var(--color-primary-dark); }
</style>
