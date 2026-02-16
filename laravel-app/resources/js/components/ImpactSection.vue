<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';

const rawStats = ref({
  beneficiaries: 0,
  communities_served: 0,
  projects_completed: 0,
  projects_ongoing: 0,
  partners: 0,
});
const displayStats = ref({
  beneficiaries: 0,
  communities_served: 0,
  projects_completed: 0,
  projects_ongoing: 0,
  partners: 0,
});
const activeStat = ref(null);
const { targetRef, inView } = useInView();

const statKeys = ['beneficiaries', 'communities_served', 'projects_completed', 'projects_ongoing', 'partners'];

function animateValue(key, end, duration = 1200) {
  const start = 0;
  const startTime = performance.now();
  function step(now) {
    const elapsed = now - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const easeOut = 1 - (1 - progress) ** 2;
    displayStats.value[key] = Math.round(start + (end - start) * easeOut);
    if (progress < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

function runCountUp() {
  if (!inView.value) return;
  statKeys.forEach((key, i) => {
    const end = rawStats.value[key] || 0;
    setTimeout(() => animateValue(key, end), 80 * i);
  });
}
watch(inView, runCountUp);
watch(rawStats, runCountUp, { deep: true });

onMounted(async () => {
  try {
    const { data } = await axios.get('/stats');
    rawStats.value = data;
    if (!inView.value) {
      displayStats.value = { ...data };
    }
  } catch (_) {}
});

function toggleStat(key) {
  activeStat.value = activeStat.value === key ? null : key;
}
</script>

<template>
  <section id="impact" ref="targetRef" class="impact">
    <div class="impact-bg"></div>
    <div class="impact-inner" :class="{ 'in-view': inView }">
      <h2 class="impact-title reveal reveal-delay-1">OUR IMPACT</h2>
      <div class="stats-row">
        <button
          type="button"
          class="stat-box reveal reveal-delay-2"
          :class="{ active: activeStat === 'beneficiaries' }"
          @click="toggleStat('beneficiaries')"
        >
          <span class="stat-number">{{ displayStats.beneficiaries }}+</span>
          <span class="stat-label">Beneficiaries Reached</span>
        </button>
        <button
          type="button"
          class="stat-box reveal reveal-delay-3"
          :class="{ active: activeStat === 'communities_served' }"
          @click="toggleStat('communities_served')"
        >
          <span class="stat-number">{{ displayStats.communities_served }}</span>
          <span class="stat-label">Communities Served</span>
        </button>
        <button
          type="button"
          class="stat-box reveal reveal-delay-4"
          :class="{ active: activeStat === 'projects_completed' }"
          @click="toggleStat('projects_completed')"
        >
          <span class="stat-number">{{ displayStats.projects_completed }}</span>
          <span class="stat-label">Projects Completed</span>
        </button>
        <button
          type="button"
          class="stat-box reveal reveal-delay-4"
          :class="{ active: activeStat === 'projects_ongoing' }"
          @click="toggleStat('projects_ongoing')"
        >
          <span class="stat-number">{{ displayStats.projects_ongoing }}</span>
          <span class="stat-label">Ongoing Projects</span>
        </button>
        <button
          type="button"
          class="stat-box reveal reveal-delay-5"
          :class="{ active: activeStat === 'partners' }"
          @click="toggleStat('partners')"
        >
          <span class="stat-number">{{ displayStats.partners }}</span>
          <span class="stat-label">Partner Organizations</span>
        </button>
      </div>
    </div>
  </section>
</template>

<style scoped>
.impact {
  padding: 5rem 1.5rem;
  color: #fff;
  position: relative;
  overflow: hidden;
}
.impact-bg {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 50%, var(--color-primary-light) 100%);
  background-size: 200% 200%;
  animation: gradient-shift 10s ease infinite;
}
.impact-inner {
  position: relative;
  z-index: 1;
  max-width: 1200px;
  margin: 0 auto;
}
.impact-inner :deep(.reveal) {
  opacity: 0;
  transform: translateY(20px) scale(0.98);
  transition: opacity 0.6s var(--ease-out-expo), transform 0.6s var(--ease-out-expo);
}
.impact-inner.in-view :deep(.reveal) {
  opacity: 1;
  transform: translateY(0) scale(1);
}
.impact-inner :deep(.reveal-delay-1) { transition-delay: 0.05s; }
.impact-inner :deep(.reveal-delay-2) { transition-delay: 0.1s; }
.impact-inner :deep(.reveal-delay-3) { transition-delay: 0.18s; }
.impact-inner :deep(.reveal-delay-4) { transition-delay: 0.26s; }
.impact-inner :deep(.reveal-delay-5) { transition-delay: 0.34s; }
.impact-title {
  font-family: var(--font-heading);
  font-size: clamp(1.75rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  margin: 0 0 2.5rem;
  text-align: center;
}
.stats-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
  gap: 1.5rem;
  text-align: center;
}
.stat-box {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  padding: 1.5rem 1rem;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  backdrop-filter: blur(8px);
  border: 2px solid rgba(255, 255, 255, 0.15);
  cursor: pointer;
  color: inherit;
  font-family: inherit;
  transition: transform 0.25s var(--ease-out-quart), background 0.25s, border-color 0.2s, box-shadow 0.25s;
}
.stat-box:hover {
  transform: translateY(-6px);
  background: rgba(255, 255, 255, 0.18);
  border-color: rgba(255, 255, 255, 0.3);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
}
.stat-box.active {
  transform: scale(1.05);
  background: rgba(255, 255, 255, 0.22);
  border-color: rgba(255, 255, 255, 0.5);
  box-shadow: 0 12px 36px rgba(0, 0, 0, 0.25);
}
.stat-number {
  font-family: var(--font-heading);
  font-size: clamp(2rem, 4vw, 2.75rem);
  font-weight: 800;
  line-height: 1;
  letter-spacing: -0.02em;
}
.stat-label {
  font-size: 0.9rem;
  font-weight: 500;
  opacity: 0.95;
}
@media (max-width: 768px) {
  .impact { padding: 3.5rem 1.5rem; }
  .stats-row { grid-template-columns: repeat(2, 1fr); }
}
</style>
