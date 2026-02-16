<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';

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
    <div class="about-wrap">
      <h2 class="section-title">ABOUT US</h2>
      <div class="about-inner">
        <div class="about-text">
          <p v-for="(p, i) in paragraphs" :key="i" class="about-p">{{ p }}</p>
        </div>
        <div class="about-images">
          <div class="about-img">
            <img
              src="/assets/img/picture3.jpeg"
              alt="Community life by the water — the communities we serve in Ghana"
            />
          </div>
          <div class="about-img">
            <img
              src="/assets/img/picture5.jpeg"
              alt="Youth and community — carrying forward with resilience"
            />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.about {
  padding: 4rem 1.5rem 4.5rem;
  background: var(--color-surface);
}
.about-wrap {
  max-width: 1100px;
  margin: 0 auto;
}
.section-title {
  font-family: var(--font-heading);
  font-size: clamp(1.75rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--color-primary);
  margin: 0 0 2rem;
  text-align: left;
}
.about-inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: start;
}
.about-text {
  padding-right: 0.5rem;
}
.about-p {
  margin: 0 0 1.25rem;
  line-height: 1.8;
  color: var(--color-body);
  font-size: 1.0625rem;
}
.about-p:last-child {
  margin-bottom: 0;
}
.about-images {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
.about-img {
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 12px 40px rgba(13, 92, 26, 0.1);
  aspect-ratio: 4 / 3;
}
.about-img img {
  width: 100%;
  height: 100%;
  display: block;
  object-fit: cover;
  transition: transform 0.5s var(--ease-out-expo);
}
.about-img:hover img {
  transform: scale(1.04);
}
@media (max-width: 768px) {
  .about { padding: 3rem 1.5rem 3.5rem; }
  .section-title { margin-bottom: 1.5rem; }
  .about-inner { grid-template-columns: 1fr; gap: 2rem; }
  .about-text { padding-right: 0; }
  .about-images { order: -1; }
  .about-img { aspect-ratio: 16 / 10; }
}
</style>
