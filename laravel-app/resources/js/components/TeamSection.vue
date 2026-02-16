<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';

const teamMembers = ref([]);
const { targetRef, inView } = useInView();

const PROFILE_PHOTOS = {
  'Harriet Yayra': '/assets/img/picture7.jpeg',
  'Senam Boven': '/assets/img/picture8.jpeg',
  'Elorm Boven': '/assets/img/picture9.jpeg',
};

function memberPhoto(member) {
  if (member.photo) return member.photo;
  if (!member.name) return null;
  for (const [key, path] of Object.entries(PROFILE_PHOTOS)) {
    if (member.name.includes(key)) return path;
  }
  return null;
}

const displayedMembers = computed(() =>
  teamMembers.value.filter((m) => !m.name || !m.name.includes('Alfred Este'))
);

onMounted(async () => {
  try {
    const { data } = await axios.get('/team');
    teamMembers.value = data;
  } catch (_) {}
});
</script>

<template>
  <section id="team" ref="targetRef" class="team">
    <div class="team-inner" :class="{ 'in-view': inView }">
      <h2 class="section-title reveal reveal-delay-1">OUR LEADERSHIP TEAM</h2>
      <div class="team-grid">
        <article
          v-for="(member, i) in displayedMembers"
          :key="member.id"
          class="team-card reveal"
          :class="'reveal-delay-' + Math.min(i + 2, 5)"
        >
          <div class="team-photo">
            <img v-if="memberPhoto(member)" :src="memberPhoto(member)" :alt="member.name" />
            <div v-else class="team-placeholder">{{ member.name.charAt(0) }}</div>
          </div>
          <h3 class="team-name">{{ member.name }}</h3>
          <p class="team-title">{{ member.title }}</p>
          <p class="team-bio">{{ member.bio }}</p>
          <a v-if="member.linkedin_url" :href="member.linkedin_url" target="_blank" rel="noopener" class="team-linkedin">LinkedIn</a>
        </article>
      </div>
    </div>
  </section>
</template>

<style scoped>
.team {
  padding: 5rem 1.5rem;
  background: var(--color-bg-alt);
}
.team-inner {
  max-width: 1200px;
  margin: 0 auto;
}
.team-inner :deep(.reveal) {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 0.55s var(--ease-out-expo), transform 0.55s var(--ease-out-expo);
}
.team-inner.in-view :deep(.reveal) {
  opacity: 1;
  transform: translateY(0);
}
.team-inner :deep(.reveal-delay-1) { transition-delay: 0.05s; }
.team-inner :deep(.reveal-delay-2) { transition-delay: 0.1s; }
.team-inner :deep(.reveal-delay-3) { transition-delay: 0.18s; }
.team-inner :deep(.reveal-delay-4) { transition-delay: 0.26s; }
.team-inner :deep(.reveal-delay-5) { transition-delay: 0.34s; }
.section-title {
  font-family: var(--font-heading);
  font-size: clamp(1.75rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--color-primary);
  margin: 0 0 2.5rem;
  text-align: center;
}
.team-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(260px, 1fr));
  gap: 2rem;
  max-width: 960px;
  margin: 0 auto;
  justify-items: center;
}
.team-card {
  width: 100%;
  max-width: 300px;
  background: var(--color-surface);
  border-radius: 20px;
  padding: 2rem;
  text-align: center;
  border: 1px solid var(--color-border);
  transition: transform var(--duration-normal), box-shadow var(--duration-normal);
}
.team-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 40px rgba(13, 92, 26, 0.1);
}
.team-photo { margin-bottom: 1.25rem; }
.team-photo img,
.team-placeholder {
  width: 112px;
  height: 112px;
  border-radius: 50%;
  object-fit: cover;
  margin: 0 auto;
  display: block;
  transition: transform var(--duration-normal);
}
.team-card:hover .team-photo img,
.team-card:hover .team-placeholder {
  transform: scale(1.05);
}
.team-placeholder {
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 2.25rem;
  font-weight: 700;
}
.team-name {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 0.25rem;
  color: var(--color-body);
}
.team-title {
  color: var(--color-primary);
  font-weight: 600;
  margin: 0 0 0.75rem;
  font-size: 0.9375rem;
}
.team-bio {
  font-size: 0.9375rem;
  line-height: 1.55;
  margin: 0;
  color: var(--color-body-muted);
}
.team-linkedin {
  display: inline-block;
  margin-top: 1rem;
  color: var(--color-primary);
  font-size: 0.875rem;
  font-weight: 600;
  text-decoration: none;
  transition: color var(--duration-fast);
}
.team-linkedin:hover { color: var(--color-primary-dark); }
@media (max-width: 900px) {
  .team-grid {
    grid-template-columns: 1fr;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
  }
  .team-card { max-width: none; }
}
@media (max-width: 768px) {
  .team { padding: 3.5rem 1.5rem; }
}
</style>
