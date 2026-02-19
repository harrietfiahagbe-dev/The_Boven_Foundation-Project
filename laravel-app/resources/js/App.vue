<script setup>
import { ref, provide, onMounted, onUnmounted } from 'vue';
import NavBar from './components/NavBar.vue';
import HeroSection from './components/HeroSection.vue';
import AboutSection from './components/AboutSection.vue';
import MissionSection from './components/MissionSection.vue';
import TeamSection from './components/TeamSection.vue';
import ProjectsSection from './components/ProjectsSection.vue';
import ImpactSection from './components/ImpactSection.vue';
import PartnersSection from './components/PartnersSection.vue';
import CtaSection from './components/CtaSection.vue';
import ContactSection from './components/ContactSection.vue';
import FooterSection from './components/FooterSection.vue';
import DonateModal from './components/DonateModal.vue';

const donateModalOpen = ref(false);

// Scroll progress indicator
onMounted(() => {
  const updateScrollProgress = () => {
    const windowHeight = window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight - windowHeight;
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const progress = documentHeight > 0 ? (scrollTop / documentHeight) * 100 : 0;
    document.documentElement.style.setProperty('--scroll-progress', `${progress}%`);
  };

  window.addEventListener('scroll', updateScrollProgress, { passive: true });
  updateScrollProgress();

  onUnmounted(() => {
    window.removeEventListener('scroll', updateScrollProgress);
  });
});

function openDonateModal() {
  donateModalOpen.value = true;
}

function closeDonateModal() {
  donateModalOpen.value = false;
}

provide('openDonateModal', openDonateModal);
provide('closeDonateModal', closeDonateModal);
</script>

<template>
  <div class="app-container boven-body">
    <div class="scroll-progress" :style="{ width: 'var(--scroll-progress, 0%)' }"></div>
    <div class="landing-page">
      <NavBar />
      <main>
        <HeroSection />
        <AboutSection />
        <MissionSection />
        <CtaSection />
        <ContactSection />
        <TeamSection />
        <ProjectsSection />
        <ImpactSection />
        <PartnersSection />
      </main>
      <FooterSection />
    </div>
    <DonateModal v-if="donateModalOpen" @close="closeDonateModal" />
  </div>
</template>

<style scoped>
.app-container { min-height: 100vh; }
.landing-page { min-height: 100vh; }
</style>
