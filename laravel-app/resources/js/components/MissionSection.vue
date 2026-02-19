<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';
import ValueIcon from './ValueIcon.vue';

const settings = ref({});
const { targetRef, inView } = useInView();

const values = computed(() => {
  try {
    return settings.value.values_json ? JSON.parse(settings.value.values_json) : [];
  } catch (_) {
    return [];
  }
});

const getIconName = (title) => {
  const iconMap = {
    'Innovation': 'innovation',
    'Integrity': 'integrity',
    'Empowerment': 'empowerment',
    'Community': 'community',
    'Inclusivity': 'inclusivity'
  };
  return iconMap[title] || 'innovation';
};

onMounted(async () => {
  try {
    const { data } = await axios.get('/settings');
    settings.value = data;
  } catch (_) {}
});
</script>

<template>
  <section id="mission" ref="targetRef" class="mission" :class="{ 'in-view': inView }">
    <div class="mission-inner">
      <h2 class="section-title reveal reveal-delay-1">Vision & Mission</h2>
      <div class="vision-mission-grid">
        <!-- Top Left: Mission Text Card -->
        <div class="mission-card card-text reveal reveal-delay-2">
          <h3 class="card-heading">OUR MISSION</h3>
          <p class="card-text-content" v-if="settings.mission_statement">{{ settings.mission_statement }}</p>
          <p class="card-text-content" v-else>To close the education gap by providing underserved youth with STEM resources, mentorship, and inclusive learning spaces that unlock their potential.</p>
        </div>
        
        <!-- Top Right: Image 1 -->
        <div class="mission-card card-image reveal reveal-delay-2">
          <div class="image-wrapper">
            <img src="/assets/img/picture2.jpeg" alt="Community impact" />
            <div class="image-overlay"></div>
          </div>
        </div>
        
        <!-- Bottom Left: Image 2 -->
        <div class="mission-card card-image reveal reveal-delay-3">
          <div class="image-wrapper">
            <img src="/assets/img/picture1.jpeg" alt="Youth empowerment" />
            <div class="image-overlay"></div>
          </div>
        </div>
        
        <!-- Bottom Right: Vision Text Card -->
        <div class="mission-card card-text reveal reveal-delay-3">
          <h3 class="card-heading">OUR VISION</h3>
          <p class="card-text-content" v-if="settings.vision_statement">{{ settings.vision_statement }}</p>
          <p class="card-text-content" v-else>To create a future where every child, regardless of gender or background, has equal access to quality STEM education, empowering them to become problem-solvers, innovators, and leaders in their communities.</p>
        </div>
      </div>
      
      <!-- Values Section -->
      <h3 class="values-heading reveal reveal-delay-4">OUR VALUES</h3>
      <div class="values-grid">
        <div v-for="(v, i) in values" :key="i" class="value-card reveal" :class="'reveal-delay-' + Math.min(i + 5, 8)">
          <div class="value-symbol">
            <ValueIcon :name="getIconName(v.title)" />
          </div>
          <h4 class="value-title">{{ v.title }}</h4>
          <p class="value-fante" v-if="v.fante">{{ v.fante }}</p>
          <p class="value-desc">{{ v.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.mission {
  padding: 5rem 1.5rem;
  background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
  position: relative;
  min-height: 400px;
}
.mission-inner {
  max-width: 1200px;
  margin: 0 auto;
}
.mission .reveal {
  opacity: 1;
  transform: translateY(0);
}
.mission:not(.in-view) .reveal {
  opacity: 0;
  transform: translateY(30px);
}
.mission.in-view .reveal {
  opacity: 1;
  transform: translateY(0);
  transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
.mission .reveal-delay-1 { transition-delay: 0.1s; }
.mission .reveal-delay-2 { transition-delay: 0.2s; }
.mission .reveal-delay-3 { transition-delay: 0.3s; }
.mission .reveal-delay-4 { transition-delay: 0.4s; }
.mission .reveal-delay-5 { transition-delay: 0.5s; }
.mission .reveal-delay-6 { transition-delay: 0.6s; }
.mission .reveal-delay-7 { transition-delay: 0.7s; }
.mission .reveal-delay-8 { transition-delay: 0.8s; }
.section-title {
  font-family: var(--font-heading);
  font-size: clamp(2rem, 4vw, 2.75rem);
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 3rem;
  text-align: center;
  letter-spacing: -0.02em;
}
.vision-mission-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: 1fr 1fr;
  gap: 2rem;
  margin-bottom: 4rem;
}
.mission-card {
  border-radius: 20px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
}
.card-text {
  background: #ffffff;
  padding: 2rem 1.75rem;
  border: 1px solid rgba(27, 94, 32, 0.1);
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.card-text:hover {
  transform: translateY(-4px);
  border-color: rgba(27, 94, 32, 0.2);
}
.card-heading {
  font-family: var(--font-heading);
  font-size: 1.375rem;
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.card-text-content {
  margin: 0;
  line-height: 1.7;
  color: #2c3e50;
  font-size: 1rem;
}
.card-image {
  position: relative;
  aspect-ratio: 4 / 3;
  transform: rotate(-1deg);
  filter: drop-shadow(0 8px 24px rgba(0, 0, 0, 0.12));
}
.card-image:nth-child(3) {
  transform: rotate(1deg);
}
.card-image:hover {
  transform: rotate(0deg) scale(1.02);
  filter: drop-shadow(0 16px 48px rgba(27, 94, 32, 0.2));
}
.image-wrapper {
  width: 100%;
  height: 100%;
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  border: 3px solid rgba(255, 255, 255, 0.9);
}
.image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), filter 0.6s ease;
  filter: brightness(0.95) contrast(1.05) saturate(1.1);
}
.card-image:hover .image-wrapper img {
  transform: scale(1.1);
  filter: brightness(1.05) contrast(1.1) saturate(1.2);
}
.image-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    135deg,
    rgba(27, 94, 32, 0.1) 0%,
    transparent 50%,
    rgba(249, 168, 37, 0.1) 100%
  );
  pointer-events: none;
  transition: opacity 0.4s ease;
}
.card-image:hover .image-overlay {
  opacity: 0.7;
}
.values-heading {
  font-family: var(--font-heading);
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--color-primary);
  margin: 3rem 0 1.5rem;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.values-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.5rem;
}
.value-card {
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(20px);
  padding: 2rem;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
  border: 1px solid rgba(27, 94, 32, 0.1);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  text-align: center;
}
.value-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(27, 94, 32, 0.12);
  border-color: rgba(27, 94, 32, 0.2);
}
.value-symbol {
  width: 64px;
  height: 64px;
  margin: 0 auto 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.value-card:hover .value-symbol {
  transform: scale(1.1);
}
.value-symbol :deep(svg) {
  width: 100%;
  height: 100%;
}
.value-title {
  font-family: var(--font-heading);
  font-size: 1.125rem;
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 0.5rem;
}
.value-fante {
  margin: 0 0 0.75rem;
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--color-primary);
  font-style: italic;
}
.value-desc {
  margin: 0;
  font-size: 0.9375rem;
  line-height: 1.6;
  color: #64748b;
}
@media (max-width: 968px) {
  .vision-mission-grid {
    grid-template-columns: 1fr;
    grid-template-rows: auto;
    gap: 1.5rem;
  }
  .card-image {
    transform: rotate(0deg) !important;
    order: -1;
  }
  .card-image:nth-child(3) {
    transform: rotate(0deg) !important;
    order: 0;
  }
  .card-image:hover {
    transform: scale(1.01) !important;
  }
}
@keyframes gradient-shift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}
@media (max-width: 768px) {
  .mission {
    padding: 3rem 1.25rem;
  }
  .section-title {
    font-size: 1.75rem;
    margin-bottom: 2rem;
  }
  .vision-mission-grid {
    gap: 1.25rem;
    margin-bottom: 3rem;
  }
  .card-text {
    padding: 1.5rem 1.25rem;
  }
  .card-heading {
    font-size: 1.125rem;
    margin-bottom: 0.75rem;
  }
  .card-text-content {
    font-size: 0.9375rem;
    line-height: 1.65;
  }
  .card-image {
    aspect-ratio: 16 / 10;
  }
  .values-heading {
    font-size: 1.125rem;
    margin: 2rem 0 1rem;
  }
  .values-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .value-card {
    padding: 1.5rem;
  }
  .value-symbol {
    width: 56px;
    height: 56px;
    margin-bottom: 0.75rem;
  }
  .value-title {
    font-size: 1rem;
  }
  .value-fante {
    font-size: 0.8125rem;
  }
  .value-title {
    font-size: 1rem;
  }
  .value-desc {
    font-size: 0.875rem;
  }
  .value-fante {
    font-size: 0.8125rem;
  }
}
</style>
