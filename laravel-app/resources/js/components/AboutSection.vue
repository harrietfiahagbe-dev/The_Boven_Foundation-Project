<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';
import AboutStatsSection from './AboutStatsSection.vue';

const DEFAULT_ABOUT = `The Boven's Foundation is a nonprofit closing the STEM education gap in underserved communities across Ghana. We believe every child deserves the tools to excel in science, technology, engineering, and mathematics — regardless of background or gender.

Starting in Elmina and expanding to communities with limited educational access, we provide hands-on learning, mentorship programs, and resources that transform how young people engage with STEM. Through workshops, improved school facilities, and partnerships with local teachers and community leaders, we're making STEM education accessible, inclusive, and impactful.

We're not just teaching — we're empowering the next generation of innovators and problem-solvers. As we grow, we're building dedicated STEM labs where students can explore, experiment, and discover their potential. One student, one school, one community at a time.`;

const aboutText = ref('');
const { targetRef } = useInView();

const paragraphs = computed(() =>
  aboutText.value ? aboutText.value.split(/\n\n+/).filter(Boolean) : []
);

onMounted(async () => {
  try {
    const { data } = await axios.get('/settings');
    aboutText.value = data.about_paragraph || DEFAULT_ABOUT;
  } catch (_) {
    aboutText.value = DEFAULT_ABOUT;
  }
});
</script>

<template>
  <section id="about" ref="targetRef" class="about">
    <div class="about-bg-pattern"></div>
    <div class="about-wrap">
      <div class="section-header">
        <span class="section-label">
          <span class="label-icon">✦</span>
          Who We Are
        </span>
        <h2 class="section-title">About Us</h2>
        <div class="title-underline"></div>
      </div>
      <div class="about-inner">
        <div class="about-text">
          <div class="text-content">
            <div class="text-card">
              <p v-for="(p, i) in paragraphs" :key="i" class="about-p">{{ p }}</p>
            </div>
          </div>
        </div>
        <div class="about-images">
          <div class="about-img about-img-main">
            <div class="img-frame"></div>
            <img
              src="/assets/img/picture3.jpeg"
              alt="Community life by the water — the communities we serve in Ghana"
            />
            <div class="img-overlay"></div>
            <div class="img-badge">Impact</div>
          </div>
          <div class="about-img about-img-secondary">
            <div class="img-frame"></div>
            <img
              src="/assets/img/picture5.jpeg"
              alt="Youth and community — carrying forward with resilience"
            />
            <div class="img-overlay"></div>
            <div class="img-badge">Community</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <AboutStatsSection />
</template>

<style scoped>
.about {
  padding: 6rem 1.5rem;
  background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 50%, #ffffff 100%);
  position: relative;
  overflow: hidden;
}
.about-bg-pattern {
  position: absolute;
  inset: 0;
  opacity: 0.03;
  background-image: 
    radial-gradient(circle at 20% 50%, var(--color-primary) 0%, transparent 50%),
    radial-gradient(circle at 80% 80%, var(--color-accent) 0%, transparent 50%);
  pointer-events: none;
}
.about-wrap {
  max-width: 1280px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.section-header {
  margin-bottom: 4rem;
  text-align: center;
  animation: fadeInUp 0.8s ease-out;
}
.section-label {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.8125rem;
  font-weight: 600;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: 1rem;
  padding: 0.5rem 1rem;
  background: rgba(249, 168, 37, 0.1);
  border-radius: 50px;
  backdrop-filter: blur(10px);
}
.label-icon {
  font-size: 1rem;
  animation: rotate 3s linear infinite;
}
@keyframes rotate {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
.section-title {
  font-family: var(--font-heading);
  font-size: clamp(2.25rem, 5vw, 3.5rem);
  font-weight: 800;
  color: var(--color-primary);
  margin: 0 0 1.5rem;
  letter-spacing: -0.02em;
  background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.title-underline {
  width: 80px;
  height: 5px;
  background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-accent) 50%, var(--color-primary) 100%);
  margin: 0 auto;
  border-radius: 3px;
  position: relative;
}
.title-underline::after {
  content: '';
  position: absolute;
  inset: -2px;
  background: linear-gradient(90deg, transparent, rgba(249, 168, 37, 0.3), transparent);
  border-radius: 3px;
  animation: shimmer 2s infinite;
}
@keyframes shimmer {
  0%, 100% { opacity: 0; }
  50% { opacity: 1; }
}
.about-inner {
  display: grid;
  grid-template-columns: 1.1fr 1fr;
  gap: 5rem;
  align-items: start;
}
.about-text {
  display: block;
}
.text-content {
  padding-right: 1.5rem;
}
.text-card {
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  padding: 2.5rem;
  box-shadow: 
    0 4px 24px rgba(0, 0, 0, 0.06),
    0 0 0 1px rgba(255, 255, 255, 0.8) inset;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.text-card:hover {
  transform: translateY(-2px);
  box-shadow: 
    0 8px 32px rgba(0, 0, 0, 0.08),
    0 0 0 1px rgba(255, 255, 255, 0.9) inset;
}
.about-p {
  margin: 0 0 1.75rem;
  line-height: 1.9;
  color: #2c3e50;
  font-size: 1.125rem;
  font-weight: 400;
}
.about-p:last-child {
  margin-bottom: 0;
}
.about-images {
  display: flex;
  flex-direction: column;
  gap: 2.5rem;
  position: relative;
}
.about-img {
  position: relative;
  border-radius: 28px;
  overflow: visible;
  cursor: pointer;
  filter: drop-shadow(0 8px 32px rgba(0, 0, 0, 0.12));
  transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.about-img::before {
  content: '';
  position: absolute;
  inset: -4px;
  border-radius: 28px;
  padding: 4px;
  background: linear-gradient(135deg, var(--color-primary), var(--color-accent), var(--color-primary));
  background-size: 300% 300%;
  opacity: 0;
  transition: opacity 0.5s ease;
  z-index: -1;
  mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
  mask-composite: exclude;
  -webkit-mask-composite: xor;
}
.about-img:hover::before {
  opacity: 0.8;
  animation: gradient-shift 4s ease infinite;
}
.about-img-main {
  aspect-ratio: 4 / 3;
  transform: rotate(-1deg);
}
.about-img-main:hover {
  transform: rotate(0deg) translateY(-12px) scale(1.02);
}
.about-img-secondary {
  aspect-ratio: 4 / 3;
  margin-left: 3rem;
  transform: rotate(1deg);
}
.about-img-secondary:hover {
  transform: rotate(0deg) translateY(-12px) scale(1.02);
}
.about-img:hover {
  filter: drop-shadow(0 20px 60px rgba(27, 94, 32, 0.25));
}
.img-frame {
  position: absolute;
  inset: 0;
  border-radius: 28px;
  overflow: hidden;
  background: linear-gradient(135deg, rgba(27, 94, 32, 0.05), rgba(249, 168, 37, 0.05));
  z-index: 1;
  pointer-events: none;
  transition: opacity 0.5s ease;
}
.about-img:hover .img-frame {
  opacity: 0;
}
.about-img img {
  width: 100%;
  height: 100%;
  display: block;
  object-fit: cover;
  border-radius: 28px;
  transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
  filter: brightness(0.98) contrast(1.05) saturate(1.1);
  border: 3px solid rgba(255, 255, 255, 0.9);
  box-shadow: 
    inset 0 0 0 1px rgba(255, 255, 255, 0.5),
    0 0 0 1px rgba(0, 0, 0, 0.05);
}
.about-img:hover img {
  transform: scale(1.1);
  filter: brightness(1.05) contrast(1.1) saturate(1.2);
  border-color: rgba(255, 255, 255, 1);
  box-shadow: 
    inset 0 0 0 1px rgba(255, 255, 255, 0.8),
    0 0 0 2px rgba(27, 94, 32, 0.1);
}
.img-overlay {
  position: absolute;
  inset: 0;
  border-radius: 28px;
  background: linear-gradient(
    180deg,
    rgba(27, 94, 32, 0.15) 0%,
    transparent 30%,
    transparent 70%,
    rgba(249, 168, 37, 0.15) 100%
  );
  pointer-events: none;
  transition: opacity 0.5s ease, background 0.5s ease;
  z-index: 2;
}
.about-img:hover .img-overlay {
  opacity: 0.6;
  background: linear-gradient(
    180deg,
    rgba(27, 94, 32, 0.25) 0%,
    transparent 30%,
    transparent 70%,
    rgba(249, 168, 37, 0.25) 100%
  );
}
.img-badge {
  position: absolute;
  top: 1.75rem;
  right: 1.75rem;
  padding: 0.625rem 1.25rem;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(255, 255, 255, 0.95));
  backdrop-filter: blur(20px) saturate(180%);
  border-radius: 50px;
  font-size: 0.75rem;
  font-weight: 800;
  color: var(--color-primary);
  letter-spacing: 0.08em;
  text-transform: uppercase;
  box-shadow: 
    0 8px 24px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(255, 255, 255, 0.8) inset,
    0 2px 8px rgba(27, 94, 32, 0.1);
  opacity: 0;
  transform: translateY(-15px) scale(0.9);
  transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
  z-index: 3;
  border: 1px solid rgba(27, 94, 32, 0.1);
}
.about-img:hover .img-badge {
  opacity: 1;
  transform: translateY(0) scale(1);
  box-shadow: 
    0 12px 32px rgba(0, 0, 0, 0.2),
    0 0 0 1px rgba(255, 255, 255, 0.9) inset,
    0 4px 12px rgba(27, 94, 32, 0.15);
}
@keyframes gradient-shift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
@media (max-width: 968px) {
  .about-inner {
    grid-template-columns: 1fr;
    gap: 4rem;
  }
  .about-images {
    order: -1;
  }
  .about-img-secondary {
    margin-left: 0;
  }
  .text-content {
    padding-right: 0;
  }
}
@media (max-width: 768px) {
  .about {
    padding: 3rem 1.25rem;
  }
  .section-header {
    margin-bottom: 2rem;
  }
  .section-label {
    font-size: 0.75rem;
    padding: 0.4rem 0.875rem;
  }
  .section-title {
    font-size: clamp(1.75rem, 5vw, 2.25rem);
    margin-bottom: 1.25rem;
  }
  .about-inner {
    gap: 2.5rem;
  }
  .text-content {
    padding-right: 0;
  }
  .text-card {
    padding: 1.75rem 1.25rem;
  }
  .about-p {
    font-size: 0.9375rem;
    line-height: 1.75;
    margin-bottom: 1.25rem;
  }
  .about-images {
    gap: 1.5rem;
  }
  .about-img-main,
  .about-img-secondary {
    aspect-ratio: 16 / 10;
    transform: rotate(0deg) !important;
  }
  .about-img-main:hover,
  .about-img-secondary:hover {
    transform: translateY(-6px) scale(1.01) !important;
  }
}
</style>
