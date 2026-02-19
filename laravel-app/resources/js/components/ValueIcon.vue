<script setup>
const props = defineProps({
  name: {
    type: String,
    required: true
  }
});

const icons = {
  innovation: `
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M12 2L3 7L12 12L21 7L12 2Z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M3 17L12 22L21 17V12L12 17L3 12V17Z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      <circle cx="12" cy="12" r="2" fill="currentColor"/>
      <path d="M8 8L10 10M14 8L16 10M8 16L10 14M14 16L16 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
    </svg>
  `,
  integrity: `
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" fill="none"/>
      <path d="M8 12L10.5 14.5L16 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      <path d="M12 8V12M12 12V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
    </svg>
  `,
  empowerment: `
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M12 3L2 9L12 15L22 9L12 3Z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M5 13.18V17.18L12 21L19 17.18V13.18L12 17L5 13.18Z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
    </svg>
  `,
  community: `
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.5" fill="none"/>
      <circle cx="15" cy="7" r="4" stroke="currentColor" stroke-width="1.5" fill="none"/>
      <path d="M3 21C3 16.58 6.58 13 11 13H13C17.42 13 21 16.58 21 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      <path d="M12 11V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
    </svg>
  `,
  inclusivity: `
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" fill="none"/>
      <circle cx="12" cy="9" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/>
      <path d="M6 21C6 17.13 8.58 14 12 14C15.42 14 18 17.13 18 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      <path d="M2 2L4 4M20 2L18 4M2 20L4 18M20 20L18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
    </svg>
  `
};
</script>

<template>
  <div class="value-icon" v-html="icons[name.toLowerCase()] || icons.innovation"></div>
</template>

<style scoped>
.value-icon {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
}
.value-icon :deep(svg) {
  width: 100%;
  height: 100%;
}
</style>
