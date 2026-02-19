import { ref, onMounted, onUnmounted } from 'vue';

/**
 * Adds an .in-view class when the element enters the viewport (with threshold).
 * Enhanced with better performance and multiple element support.
 * Use with CSS .reveal and .in-view for scroll-triggered animations.
 * @param {Object} options - { threshold: number, rootMargin: string, once: boolean }
 * @returns {{ targetRef: Ref<HTMLElement|null>, inView: Ref<boolean> }}
 */
export function useInView(options = {}) {
  const targetRef = ref(null);
  const inView = ref(false);

  const { 
    threshold = 0.12, 
    rootMargin = '0px 0px -8% 0px',
    once = true // Only trigger once by default for better performance
  } = options;

  onMounted(() => {
    const el = targetRef.value;
    if (!el) return;

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          inView.value = true;
          // If once is true, disconnect after first intersection
          if (once) {
            observer.disconnect();
          }
        } else if (!once) {
          inView.value = false;
        }
      },
      { 
        threshold, 
        rootMargin,
        // Use passive for better scroll performance
      }
    );
    
    // Small delay to ensure element is rendered
    requestAnimationFrame(() => {
      if (el) observer.observe(el);
    });
    
    onUnmounted(() => observer.disconnect());
  });

  return { targetRef, inView };
}
