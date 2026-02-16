<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useInView } from '../composables/useInView';

const form = ref({
  name: '',
  email: '',
  subject: '',
  message: '',
});
const sending = ref(false);
const success = ref(false);
const error = ref('');
const settings = ref({});
const { targetRef, inView } = useInView();

onMounted(async () => {
  try {
    const { data } = await axios.get('/settings');
    settings.value = data;
  } catch (_) {}
});

async function submit() {
  error.value = '';
  success.value = false;
  if (!form.value.name || !form.value.email || !form.value.subject || !form.value.message) {
    error.value = 'Please fill in all fields.';
    return;
  }
  sending.value = true;
  try {
    await axios.post('/contact', form.value);
    success.value = true;
    form.value = { name: '', email: '', subject: '', message: '' };
  } catch (e) {
    error.value = e.response?.data?.message || 'Something went wrong. Please try again.';
  } finally {
    sending.value = false;
  }
}
</script>

<template>
  <section id="contact" ref="targetRef" class="contact">
    <div class="contact-inner" :class="{ 'in-view': inView }">
      <h2 class="section-title reveal reveal-delay-1">CONTACT US</h2>
      <div class="contact-grid">
        <div class="contact-info reveal reveal-delay-2">
          <p><strong>Email:</strong> <a :href="`mailto:${settings.ngo_email || 'thebovenfoundation@gmail.com'}`">{{ settings.ngo_email || 'thebovenfoundation@gmail.com' }}</a></p>
          <p><strong>Address:</strong> {{ settings.ngo_address || 'Elmina, Cape Coast, Ghana.' }}</p>
        </div>
        <form class="contact-form reveal reveal-delay-3" @submit.prevent="submit">
          <div v-if="success" class="form-success">Thank you. Your message has been sent.</div>
          <div v-if="error" class="form-error">{{ error }}</div>
          <label>
            <span>Name</span>
            <input v-model="form.name" type="text" required />
          </label>
          <label>
            <span>Email</span>
            <input v-model="form.email" type="email" required />
          </label>
          <label>
            <span>Subject</span>
            <input v-model="form.subject" type="text" required />
          </label>
          <label>
            <span>Message</span>
            <textarea v-model="form.message" rows="4" required></textarea>
          </label>
          <button type="submit" class="btn-submit" :disabled="sending">{{ sending ? 'Sending…' : 'Send Message' }}</button>
        </form>
      </div>
    </div>
  </section>
</template>

<style scoped>
.contact {
  padding: 5rem 1.5rem;
  background: rgba(248, 250, 248, 0.9);
}
.contact-inner {
  max-width: 800px;
  margin: 0 auto;
}
.contact-inner :deep(.reveal) {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.55s var(--ease-out-expo), transform 0.55s var(--ease-out-expo);
}
.contact-inner.in-view :deep(.reveal) {
  opacity: 1;
  transform: translateY(0);
}
.contact-inner :deep(.reveal-delay-1) { transition-delay: 0.05s; }
.contact-inner :deep(.reveal-delay-2) { transition-delay: 0.12s; }
.contact-inner :deep(.reveal-delay-3) { transition-delay: 0.2s; }
.section-title {
  font-family: var(--font-heading);
  font-size: clamp(1.75rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--color-primary);
  margin: 0 0 2rem;
  text-align: center;
}
.contact-grid { display: grid; gap: 2.5rem; }
.contact-info p { margin: 0 0 0.5rem; font-size: 1rem; }
.contact-info a {
  color: var(--color-primary);
  font-weight: 600;
  text-decoration: none;
  transition: color var(--duration-fast);
}
.contact-info a:hover { color: var(--color-primary-dark); }
.contact-form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
.contact-form label { display: flex; flex-direction: column; gap: 0.35rem; }
.contact-form label span { font-weight: 600; font-size: 0.9375rem; color: var(--color-body); }
.contact-form input,
.contact-form textarea {
  padding: 0.75rem 1rem;
  border: 2px solid var(--color-border);
  border-radius: 12px;
  font-family: var(--font-sans);
  font-size: 1rem;
  transition: border-color var(--duration-fast), box-shadow var(--duration-fast);
}
.contact-form input:focus,
.contact-form textarea:focus {
  outline: none;
  border-color: var(--color-primary);
  box-shadow: 0 0 0 4px rgba(13, 92, 26, 0.12);
}
.form-success { color: var(--color-primary); font-weight: 600; }
.form-error { color: #c62828; font-weight: 500; }
.btn-submit {
  padding: 0.875rem 1.5rem;
  background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
  color: #fff;
  border: none;
  border-radius: 12px;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: transform var(--duration-fast), box-shadow var(--duration-normal);
}
.btn-submit:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(13, 92, 26, 0.35);
}
.btn-submit:disabled { opacity: 0.7; cursor: not-allowed; }
</style>
