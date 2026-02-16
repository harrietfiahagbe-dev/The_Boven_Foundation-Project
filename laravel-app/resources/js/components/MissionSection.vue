<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';

const settings = ref({});
const poppedBlock = ref(null);
const { targetRef, inView } = useInView();

function togglePop(key) {
  poppedBlock.value = poppedBlock.value === key ? null : key;
}

const FANTE_BY_TITLE = {
  innovation: 'Adwumayɛ fofor',
  integrity: 'Nokwaredi',
  empowerment: 'Hyɛ obi den',
  community: 'Mpɔtam',
  inclusivity: 'Obiara ka ho bi',
};

const VALUE_ICONS = {
  innovation: 'innovation',
  integrity: 'integrity',
  empowerment: 'empowerment',
  community: 'community',
  inclusivity: 'inclusivity',
};

const values = computed(() => {
  try {
    const raw = settings.value.values_json ? JSON.parse(settings.value.values_json) : [];
    return raw.map((v) => ({
      ...v,
      fante: FANTE_BY_TITLE[(v.title || '').toLowerCase().trim()] || '',
      icon: VALUE_ICONS[(v.title || '').toLowerCase().trim()] || 'default',
    }));
  } catch (_) {
    return [];
  }
});

onMounted(async () => {
  try {
    const { data } = await axios.get('/settings');
    settings.value = data;
  } catch (_) {}
});
</script>

<template>
  <section id="mission" ref="targetRef" class="mission">
    <div class="mission-banner reveal reveal-delay-1">
      <img src="/assets/img/picture1.jpeg" alt="" role="presentation" />
      <div class="mission-banner-overlay"></div>
    </div>
    <div class="mission-inner" :class="{ 'in-view': inView }">
      <h2 class="section-title reveal reveal-delay-1">VISION & MISSION</h2>
      <div class="vision-mission-wrap">
        <div
          class="vision-block reveal reveal-delay-2"
          :class="{ pop: poppedBlock === 'vision' }"
          role="button"
          tabindex="0"
          @click="togglePop('vision')"
          @keydown.enter.space.prevent="togglePop('vision')"
          v-if="settings.vision_statement"
        >
          <h3 class="block-heading">Our Vision</h3>
          <p class="vision-text">{{ settings.vision_statement }}</p>
        </div>
        <div
          class="mission-block reveal reveal-delay-2"
          :class="{ pop: poppedBlock === 'mission' }"
          role="button"
          tabindex="0"
          @click="togglePop('mission')"
          @keydown.enter.space.prevent="togglePop('mission')"
          v-if="settings.mission_statement"
        >
          <h3 class="block-heading">Our Mission</h3>
          <p class="mission-text">{{ settings.mission_statement }}</p>
        </div>
      </div>
      <h3 class="values-heading reveal reveal-delay-3">OUR VALUES</h3>
      <div class="values-grid">
        <div v-for="(v, i) in values" :key="i" class="value-card reveal" :class="'reveal-delay-' + Math.min(i + 4, 5)">
          <div class="value-icon" :aria-hidden="true">
            <!-- Innovation: bulb | Integrity: shield | Empowerment: hand | Community: people | Inclusivity: heart -->
            <svg v-if="v.icon === 'innovation'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"/></svg>
            <svg v-else-if="v.icon === 'integrity'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <svg v-else-if="v.icon === 'empowerment'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"/><path d="M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v2"/><path d="M10 10.5V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v8"/><path d="M18 8a2 2 0 1 1 4 0v4a2 2 0 0 1-4 0V8z"/><path d="M14 12a2 2 0 0 1 4 0v6a2 2 0 0 1-4 0v-6z"/></svg>
            <svg v-else-if="v.icon === 'community'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <svg v-else-if="v.icon === 'inclusivity'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="M12 18v4"/><path d="m4.93 4.93 2.83 2.83"/><path d="m16.24 16.24 2.83 2.83"/><path d="M2 12h4"/><path d="M18 12h4"/><path d="m4.93 19.07 2.83-2.83"/><path d="m16.24 7.76 2.83-2.83"/></svg>
          </div>
          <h3 class="value-title">{{ v.title }}</h3>
          <p v-if="v.fante" class="value-fante"><em>{{ v.fante }}</em></p>
          <p class="value-desc">{{ v.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.mission {
  padding: 0 0 5rem;
  background: var(--color-bg-alt);
}
.mission-banner {
  height: 200px;
  margin-bottom: 2.5rem;
  border-radius: 0;
  overflow: hidden;
  position: relative;
}
.mission-banner img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.mission-banner-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, transparent 0%, rgba(13, 92, 26, 0.25) 100%);
  pointer-events: none;
}
.mission-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}
.mission-inner :deep(.reveal) {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 0.6s var(--ease-out-expo), transform 0.6s var(--ease-out-expo);
}
.mission-inner.in-view :deep(.reveal) {
  opacity: 1;
  transform: translateY(0);
}
.mission-inner :deep(.reveal-delay-1) { transition-delay: 0.05s; }
.mission-inner :deep(.reveal-delay-2) { transition-delay: 0.12s; }
.mission-inner :deep(.reveal-delay-3) { transition-delay: 0.2s; }
.mission-inner :deep(.reveal-delay-4) { transition-delay: 0.28s; }
.mission-inner :deep(.reveal-delay-5) { transition-delay: 0.36s; }
.section-title {
  font-family: var(--font-heading);
  font-size: clamp(1.5rem, 2.5vw, 2rem);
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--color-primary);
  margin: 0 0 2rem;
  text-align: center;
}
.vision-mission-wrap {
  max-width: 720px;
  margin: 0 auto;
}
.vision-block,
.mission-block {
  margin: 0 auto 1.75rem;
  padding: 2rem;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 20px;
  box-shadow: 0 4px 24px rgba(13, 92, 26, 0.06);
  border: 1px solid var(--color-border);
  cursor: pointer;
  transition:
    transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1),
    box-shadow 0.4s ease,
    border-color 0.3s ease;
}
.vision-block:hover,
.mission-block:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 40px rgba(13, 92, 26, 0.1);
}
.vision-block.pop,
.mission-block.pop {
  transform: scale(1.04) translateY(-4px);
  box-shadow: 0 16px 48px rgba(13, 92, 26, 0.15);
  z-index: 2;
  position: relative;
  border-color: rgba(13, 92, 26, 0.35);
}
.block-heading {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--color-primary);
  margin: 0 0 0.75rem;
}
.vision-text,
.mission-text {
  margin: 0;
  line-height: 1.75;
  color: var(--color-body);
  font-size: 1.0625rem;
}
.values-heading {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  font-weight: 600;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--color-primary);
  margin: 2.5rem 0 1.25rem;
  text-align: center;
}
.values-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  margin-top: 1.5rem;
}
.value-card {
  background: var(--color-surface);
  padding: 1.75rem;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(13, 92, 26, 0.06);
  border: 1px solid var(--color-border);
  transition: transform var(--duration-normal), box-shadow var(--duration-normal);
  text-align: center;
}
.value-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(13, 92, 26, 0.12);
}
.value-icon {
  color: var(--color-primary);
  margin-bottom: 0.75rem;
  display: flex;
  justify-content: center;
}
.value-icon svg {
  display: block;
}
.value-title {
  font-family: var(--font-heading);
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--color-primary);
  margin: 0 0 0.25rem;
}
.value-fante {
  margin: 0 0 0.5rem;
  font-size: 0.9rem;
  color: var(--color-body-muted);
  font-style: italic;
}
.value-desc {
  margin: 0;
  font-size: 0.9375rem;
  line-height: 1.55;
  color: var(--color-body-muted);
}
</style>
