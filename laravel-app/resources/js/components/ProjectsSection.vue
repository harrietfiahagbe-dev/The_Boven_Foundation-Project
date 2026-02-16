<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';

const PROJECT_PLACEHOLDER_IMAGES = [
  'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600',
  'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600',
  'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600',
  'https://images.unsplash.com/photo-1529070538774-1843cb3265df?w=600',
  'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=600',
  'https://images.unsplash.com/photo-1568667256549-094345857637?w=600',
];

const projects = ref([]);
const { targetRef, inView } = useInView();

function projectImage(project, index) {
  if (project.image) return project.image;
  return PROJECT_PLACEHOLDER_IMAGES[index % PROJECT_PLACEHOLDER_IMAGES.length];
}

onMounted(async () => {
  try {
    const { data } = await axios.get('/projects');
    projects.value = data;
  } catch (_) {}
});
</script>

<template>
  <section id="projects" ref="targetRef" class="projects">
    <div class="projects-inner" :class="{ 'in-view': inView }">
      <h2 class="section-title reveal reveal-delay-1">OUR PROJECTS</h2>
      <div class="projects-grid">
        <article
          v-for="(project, i) in projects"
          :key="project.id"
          class="project-card reveal"
          :class="'reveal-delay-' + Math.min(i + 2, 5)"
        >
          <div class="project-image">
            <img :src="projectImage(project, i)" :alt="project.title" />
          </div>
          <div class="project-body">
            <span class="project-badge" :class="project.status">{{ project.status }}</span>
            <h3 class="project-title">{{ project.title }}</h3>
            <p class="project-desc">{{ project.description }}</p>
            <p v-if="project.year" class="project-meta">Year: {{ project.year }}{{ project.location ? ` · ${project.location}` : '' }}</p>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>

<style scoped>
.projects {
  padding: 5rem 1.5rem;
  background: var(--color-bg-alt);
}
.projects-inner {
  max-width: 1200px;
  margin: 0 auto;
}
.projects-inner :deep(.reveal) {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 0.55s var(--ease-out-expo), transform 0.55s var(--ease-out-expo);
}
.projects-inner.in-view :deep(.reveal) {
  opacity: 1;
  transform: translateY(0);
}
.projects-inner :deep(.reveal-delay-1) { transition-delay: 0.05s; }
.projects-inner :deep(.reveal-delay-2) { transition-delay: 0.1s; }
.projects-inner :deep(.reveal-delay-3) { transition-delay: 0.18s; }
.projects-inner :deep(.reveal-delay-4) { transition-delay: 0.26s; }
.projects-inner :deep(.reveal-delay-5) { transition-delay: 0.34s; }
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
.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 2rem;
}
.project-card {
  background: var(--color-surface);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 4px 24px rgba(13, 92, 26, 0.06);
  border: 1px solid var(--color-border);
  transition: transform var(--duration-normal), box-shadow var(--duration-normal);
}
.project-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 48px rgba(13, 92, 26, 0.12);
}
.project-image {
  overflow: hidden;
}
.project-image img {
  width: 100%;
  height: 220px;
  object-fit: cover;
  transition: transform var(--duration-slow) var(--ease-out-expo);
}
.project-card:hover .project-image img {
  transform: scale(1.08);
}
.project-body { padding: 1.5rem; }
.project-badge {
  display: inline-block;
  padding: 0.35rem 0.75rem;
  border-radius: 10px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: capitalize;
  margin-bottom: 0.75rem;
}
.project-badge.completed {
  background: rgba(13, 92, 26, 0.12);
  color: var(--color-primary);
}
.project-badge.ongoing {
  background: rgba(33, 150, 243, 0.12);
  color: #1976d2;
}
.project-title {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 0.5rem;
  color: var(--color-body);
}
.project-desc {
  font-size: 0.9375rem;
  line-height: 1.55;
  margin: 0;
  color: var(--color-body-muted);
}
.project-meta {
  font-size: 0.8125rem;
  color: var(--color-body-muted);
  margin-top: 0.75rem;
}
@media (max-width: 768px) {
  .projects { padding: 3.5rem 1.5rem; }
  .projects-grid { grid-template-columns: 1fr; }
}
</style>
