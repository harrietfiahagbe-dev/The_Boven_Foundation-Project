<script setup>
import { useInView } from '../composables/useInView';
import { useSmoothScroll } from '../composables/useSmoothScroll';

const { targetRef, inView } = useInView();
const { scrollToElement } = useSmoothScroll();

function handleImageError(event) {
  event.target.style.display = 'none';
}

const partners = [
  { name: 'Ministry of Gender, Children & Social Protection', logo: '/assets/img/min of edu.png' },
  { name: 'Ministry of Education', logo: '/assets/img/Ministry-of-Education.jpg' },
  { name: 'UNDP', logo: '/assets/img/UNDP.png' },
  { name: 'UNICEF', logo: '/assets/img/unicef.webp' },
];
</script>

<template>
  <section class="partners" ref="targetRef">
    <div class="partners-inner" :class="{ 'in-view': inView }">
      <h2 class="section-title reveal reveal-delay-1">PARTNERS & SUPPORTERS</h2>
      <p class="partners-text reveal reveal-delay-2">
        We work with schools, community leaders, and organizations to maximize our impact. Interested in partnering?
        <a href="#contact" @click.prevent="scrollToElement('#contact', 80)">Get in touch</a>.
      </p>
      <div class="partners-logos reveal reveal-delay-3">
        <div v-for="(partner, i) in partners" :key="i" class="partner-logo">
          <img :src="partner.logo" :alt="partner.name" @error="handleImageError($event)" />
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.partners {
  padding: 5rem 1.5rem;
  background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
  position: relative;
}
.partners-inner {
  max-width: 1200px;
  margin: 0 auto;
  text-align: center;
}
.partners-inner :deep(.reveal) {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}
.partners-inner.in-view :deep(.reveal) {
  opacity: 1;
  transform: translateY(0);
}
.partners-inner :deep(.reveal-delay-1) { transition-delay: 0.1s; }
.partners-inner :deep(.reveal-delay-2) { transition-delay: 0.2s; }
.partners-inner :deep(.reveal-delay-3) { transition-delay: 0.3s; }
.section-title {
  font-family: var(--font-heading);
  font-size: clamp(1.75rem, 3vw, 2.25rem);
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 1rem;
  letter-spacing: -0.02em;
  text-transform: uppercase;
}
.partners-text {
  color: #64748b;
  line-height: 1.7;
  margin: 0 0 3rem;
  font-size: 1.0625rem;
  max-width: 640px;
  margin-left: auto;
  margin-right: auto;
}
.partners-text a {
  color: var(--color-primary);
  font-weight: 600;
  text-decoration: none;
  transition: color 0.2s ease;
}
.partners-text a:hover {
  color: var(--color-accent);
  text-decoration: underline;
}
.partners-logos {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 2rem;
  align-items: center;
  justify-items: center;
  padding: 2rem 0;
}
.partner-logo {
  width: 100%;
  max-width: 180px;
  height: 180px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(10px);
  border-radius: 50%;
  padding: 1.5rem;
  border: 1px solid rgba(27, 94, 32, 0.1);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.partner-logo::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(27, 94, 32, 0.05), rgba(249, 168, 37, 0.05));
  opacity: 0;
  transition: opacity 0.3s ease;
}
.partner-logo:hover {
  transform: translateY(-6px) scale(1.05);
  box-shadow: 0 12px 32px rgba(27, 94, 32, 0.15);
  border-color: rgba(27, 94, 32, 0.2);
  background: rgba(255, 255, 255, 0.5);
}
.partner-logo:hover::before {
  opacity: 1;
}
.partner-logo img {
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  object-fit: contain;
  filter: grayscale(0.2) opacity(0.9);
  transition: all 0.3s ease;
  position: relative;
  z-index: 1;
}
.partner-logo:hover img {
  filter: grayscale(0) opacity(1);
  transform: scale(1.1);
}
.logo-placeholder {
  font-size: 0.875rem;
  color: #94a3b8;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  position: relative;
  z-index: 1;
}
.partner-logo:hover .logo-placeholder {
  color: var(--color-primary);
}
@media (max-width: 768px) {
  .partners {
    padding: 3rem 1.25rem;
  }
  .section-title {
    font-size: 1.5rem;
    margin-bottom: 0.75rem;
  }
  .partners-text {
    font-size: 0.9375rem;
    margin-bottom: 2rem;
  }
  .partners-logos {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    padding: 1rem 0;
  }
  .partner-logo {
    max-width: 140px;
    height: 140px;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.2);
  }
  .partner-logo:hover {
    background: rgba(255, 255, 255, 0.4);
  }
  .logo-placeholder {
    font-size: 0.75rem;
  }
}
</style>
