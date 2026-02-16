import { ref, onMounted, onUnmounted } from 'vue';

/**
 * Adds an .in-view class when the element enters the viewport (with threshold).
 * Use with CSS .reveal and .in-view for scroll-triggered animations.
 * @param {Object} options - { threshold: number, rootMargin: string }
 * @returns {{ targetRef: Ref<HTMLElement|null>, inView: Ref<boolean> }}
 */
export function useInView(options = {}) {
  const targetRef = ref(null);
  const inView = ref(false);

  const { threshold = 0.12, rootMargin = '0px 0px -8% 0px' } = options;

  onMounted(() => {
    const el = targetRef.value;
    if (!el) return;

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) inView.value = true;
      },
      { threshold, rootMargin }
    );
    observer.observe(el);
    onUnmounted(() => observer.disconnect());
  });

  return { targetRef, inView };
}
