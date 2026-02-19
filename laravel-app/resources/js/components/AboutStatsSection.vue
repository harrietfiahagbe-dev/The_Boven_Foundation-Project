<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';

const { targetRef, inView } = useInView();
const stats = ref({
  communities: 0,
  students: 0,
  values: 5
});

const displayStats = ref({
  communities: 0,
  students: 0,
  values: 5
});

onMounted(async () => {
  try {
    const { data } = await axios.get('/settings');
    stats.value = {
      communities: parseInt(data.stat_communities || '3'),
      students: parseInt(data.stat_beneficiaries || '500'),
      values: 5
    };
    animateStats();
  } catch (_) {
    animateStats();
  }
});

function animateStats() {
  const duration = 1500;
  const steps = 60;
  const stepDuration = duration / steps;
  
  ['communities', 'students', 'values'].forEach(key => {
    const end = stats.value[key];
    let current = 0;
    const increment = end / steps;
    
    const timer = setInterval(() => {
      current += increment;
      if (current >= end) {
        displayStats.value[key] = end;
        clearInterval(timer);
      } else {
        displayStats.value[key] = Math.floor(current);
      }
    }, stepDuration);
  });
}
</script>

<template>
  <section class="about-stats" ref="targetRef" :class="{ 'in-view': inView }">
    <div class="stats-container">
      <div class="stat-card reveal reveal-delay-1">
        <div class="stat-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2Z" stroke="currentColor" stroke-width="1.5" fill="none"/>
            <circle cx="12" cy="9" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/>
          </svg>
        </div>
        <div class="stat-number">{{ displayStats.communities }}+</div>
        <div class="stat-label">Communities Served</div>
      </div>
      
      <div class="stat-card reveal reveal-delay-2">
        <div class="stat-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2 17L12 22L22 17V12L12 17L2 12V17Z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
          </svg>
        </div>
        <div class="stat-number">{{ displayStats.students }}+</div>
        <div class="stat-label">Students Reached</div>
      </div>
      
      <div class="stat-card reveal reveal-delay-3">
        <div class="stat-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L3 7L12 12L21 7L12 2Z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M3 17L12 22L21 17V12L12 17L3 12V17Z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="12" cy="12" r="2" fill="currentColor"/>
            <path d="M8 8L10 10M14 8L16 10M8 16L10 14M14 16L16 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="stat-number">{{ displayStats.values }}</div>
        <div class="stat-label">Core Values</div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.about-stats {
  padding: 1.5rem 1.5rem;
  background: linear-gradient(135deg, rgba(13, 92, 26, 0.02) 0%, rgba(249, 168, 37, 0.02) 100%);
  position: relative;
  overflow: hidden;
}
.about-stats::before {
  content: '';
  position: absolute;
  inset: 0;
  background: 
    radial-gradient(circle at 20% 30%, rgba(13, 92, 26, 0.08) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(249, 168, 37, 0.08) 0%, transparent 50%);
  pointer-events: none;
}
.stats-container {
  max-width: 900px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
  position: relative;
  z-index: 1;
}
.stat-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border-radius: 12px;
  padding: 1rem 0.75rem;
  text-align: center;
  border: 1px solid rgba(27, 94, 32, 0.1);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}
.stat-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(27, 94, 32, 0.03), rgba(249, 168, 37, 0.03));
  opacity: 0;
  transition: opacity 0.4s ease;
}
.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(27, 94, 32, 0.1);
  border-color: rgba(27, 94, 32, 0.2);
}
.stat-card:hover::before {
  opacity: 1;
}
.stat-icon {
  width: 36px;
  height: 36px;
  margin: 0 auto 0.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  z-index: 1;
}
.stat-card:hover .stat-icon {
  transform: scale(1.1);
  color: var(--color-primary-dark);
}
.stat-icon svg {
  width: 100%;
  height: 100%;
}
.stat-number {
  font-family: var(--font-heading);
  font-size: clamp(1.5rem, 2.5vw, 2rem);
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 0.25rem;
  line-height: 1;
  position: relative;
  z-index: 1;
}
.stat-label {
  font-size: 0.75rem;
  font-weight: 600;
  color: var(--color-body-muted);
  text-transform: uppercase;
  letter-spacing: 0.06em;
  position: relative;
  z-index: 1;
}
.about-stats .reveal {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
.about-stats.in-view .reveal {
  opacity: 1;
  transform: translateY(0);
}
.about-stats .reveal-delay-1 { transition-delay: 0.1s; }
.about-stats .reveal-delay-2 { transition-delay: 0.2s; }
.about-stats .reveal-delay-3 { transition-delay: 0.3s; }
@media (max-width: 768px) {
  .about-stats {
    padding: 1.25rem 1.25rem;
  }
  .stats-container {
    grid-template-columns: 1fr;
    gap: 0.75rem;
  }
  .stat-card {
    padding: 1rem 0.75rem;
  }
  .stat-icon {
    width: 32px;
    height: 32px;
    margin-bottom: 0.5rem;
  }
  .stat-number {
    font-size: 1.5rem;
  }
  .stat-label {
    font-size: 0.6875rem;
  }
}
</style>
