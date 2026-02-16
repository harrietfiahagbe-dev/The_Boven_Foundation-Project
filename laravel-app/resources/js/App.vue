<script setup>
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
</script>

<template>
  <div class="landing-page boven-body">
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
</template>

<style scoped>
.landing-page { min-height: 100vh; }
</style>
