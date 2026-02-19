import { onMounted, onUnmounted } from 'vue';

/**
 * Enhanced smooth scroll utility with better easing and offset support
 */
export function useSmoothScroll() {
  let scrollTimeout = null;
  let isScrolling = false;

  function smoothScrollTo(element, offset = 0, duration = 800) {
    if (!element) return;

    const start = window.pageYOffset || document.documentElement.scrollTop;
    const target = element.getBoundingClientRect().top + start - offset;
    const distance = target - start;
    let startTime = null;

    // Easing function - easeInOutCubic
    function easeInOutCubic(t) {
      return t < 0.5
        ? 4 * t * t * t
        : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    function animation(currentTime) {
      if (startTime === null) startTime = currentTime;
      const timeElapsed = currentTime - startTime;
      const progress = Math.min(timeElapsed / duration, 1);
      const ease = easeInOutCubic(progress);

      window.scrollTo(0, start + distance * ease);

      if (progress < 1) {
        requestAnimationFrame(animation);
      } else {
        isScrolling = false;
      }
    }

    isScrolling = true;
    requestAnimationFrame(animation);
  }

  function scrollToElement(selector, offset = 80) {
    const element = typeof selector === 'string' 
      ? document.querySelector(selector) || document.getElementById(selector.replace('#', ''))
      : selector;
    
    if (element) {
      smoothScrollTo(element, offset);
    }
  }

  // Handle scroll events with throttling
  function handleScroll() {
    if (scrollTimeout) {
      cancelAnimationFrame(scrollTimeout);
    }
    
    scrollTimeout = requestAnimationFrame(() => {
      // Add any scroll-based effects here
      const scrollY = window.scrollY || window.pageYOffset;
      document.documentElement.style.setProperty('--scroll-y', `${scrollY}px`);
    });
  }

  onMounted(() => {
    window.addEventListener('scroll', handleScroll, { passive: true });
  });

  onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    if (scrollTimeout) {
      cancelAnimationFrame(scrollTimeout);
    }
  });

  return {
    scrollToElement,
    smoothScrollTo,
    isScrolling: () => isScrolling
  };
}
