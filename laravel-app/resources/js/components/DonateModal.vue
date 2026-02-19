<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const emit = defineEmits(['close']);
const copySuccess = ref('');
const copiedField = ref('');

function copyToClipboard(text, field) {
  navigator.clipboard.writeText(text).then(() => {
    copySuccess.value = field;
    copiedField.value = field;
    setTimeout(() => {
      copySuccess.value = '';
      copiedField.value = '';
    }, 2000);
  });
}

function close() {
  emit('close');
}

function onBackdropClick(e) {
  if (e.target === e.currentTarget) close();
}

function onKeydown(e) {
  if (e.key === 'Escape') close();
}

onMounted(() => {
  document.addEventListener('keydown', onKeydown);
  document.body.style.overflow = 'hidden';
});

onUnmounted(() => {
  document.removeEventListener('keydown', onKeydown);
  document.body.style.overflow = '';
});
</script>

<template>
  <Teleport to="body">
    <div class="donate-modal-backdrop" @click="onBackdropClick">
      <div class="donate-modal" role="dialog" aria-modal="true" aria-labelledby="donate-modal-title" @click.stop>
        <button type="button" class="donate-modal-close" aria-label="Close" @click="close">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>

        <div class="donate-modal-content">
          <div class="donate-header">
            <h1 id="donate-modal-title" class="donate-title">Support Our Mission</h1>
            <p class="donate-subtitle">Your contribution helps us provide STEM education to underserved youth in Ghana</p>
          </div>

          <div class="payment-methods">
            <!-- Bank Transfer -->
            <div class="payment-card">
              <div class="payment-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="2" y="8" width="20" height="12" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                  <path d="M2 12H22" stroke="currentColor" stroke-width="1.5"/>
                  <path d="M6 16H8M10 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  <path d="M4 4L12 2L20 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                </svg>
              </div>
              <h2 class="payment-title">Bank Transfer</h2>
              <p class="payment-desc">Transfer directly to our bank account</p>
              <div class="payment-details">
                <div class="detail-row">
                  <span class="detail-label">Bank Name:</span>
                  <div class="detail-value-group">
                    <span class="detail-value">Ghana Commercial Bank (GCB)</span>
                    <button type="button" @click="copyToClipboard('Ghana Commercial Bank (GCB)', 'bank')" class="copy-btn" :class="{ copied: copiedField === 'bank' }">
                      {{ copiedField === 'bank' ? '✓ Copied' : 'Copy' }}
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Account Name:</span>
                  <div class="detail-value-group">
                    <span class="detail-value">The Boven Foundation</span>
                    <button type="button" @click="copyToClipboard('The Boven Foundation', 'account-name')" class="copy-btn" :class="{ copied: copiedField === 'account-name' }">
                      {{ copiedField === 'account-name' ? '✓ Copied' : 'Copy' }}
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Account Number:</span>
                  <div class="detail-value-group">
                    <span class="detail-value">1234567890123</span>
                    <button type="button" @click="copyToClipboard('1234567890123', 'account-number')" class="copy-btn" :class="{ copied: copiedField === 'account-number' }">
                      {{ copiedField === 'account-number' ? '✓ Copied' : 'Copy' }}
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Branch:</span>
                  <div class="detail-value-group">
                    <span class="detail-value">Elmina Branch</span>
                    <button type="button" @click="copyToClipboard('Elmina Branch', 'branch')" class="copy-btn" :class="{ copied: copiedField === 'branch' }">
                      {{ copiedField === 'branch' ? '✓ Copied' : 'Copy' }}
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">SWIFT Code:</span>
                  <div class="detail-value-group">
                    <span class="detail-value">GCBLGHAC</span>
                    <button type="button" @click="copyToClipboard('GCBLGHAC', 'swift')" class="copy-btn" :class="{ copied: copiedField === 'swift' }">
                      {{ copiedField === 'swift' ? '✓ Copied' : 'Copy' }}
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Mobile Money -->
            <div class="payment-card">
              <div class="payment-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="5" y="2" width="14" height="20" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                  <path d="M9 6H15M9 10H15M9 14H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  <circle cx="12" cy="18" r="1" fill="currentColor"/>
                </svg>
              </div>
              <h2 class="payment-title">Mobile Money</h2>
              <p class="payment-desc">Send via MTN Mobile Money, Vodafone Cash, or AirtelTigo Money</p>
              <div class="payment-details">
                <div class="detail-row">
                  <span class="detail-label">MTN Mobile Money:</span>
                  <div class="detail-value-group">
                    <span class="detail-value">0244 123 4567</span>
                    <button type="button" @click="copyToClipboard('02441234567', 'mtn')" class="copy-btn" :class="{ copied: copiedField === 'mtn' }">
                      {{ copiedField === 'mtn' ? '✓ Copied' : 'Copy' }}
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Vodafone Cash:</span>
                  <div class="detail-value-group">
                    <span class="detail-value">0204 123 4567</span>
                    <button type="button" @click="copyToClipboard('02041234567', 'vodafone')" class="copy-btn" :class="{ copied: copiedField === 'vodafone' }">
                      {{ copiedField === 'vodafone' ? '✓ Copied' : 'Copy' }}
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">AirtelTigo Money:</span>
                  <div class="detail-value-group">
                    <span class="detail-value">0274 123 4567</span>
                    <button type="button" @click="copyToClipboard('02741234567', 'airteltigo')" class="copy-btn" :class="{ copied: copiedField === 'airteltigo' }">
                      {{ copiedField === 'airteltigo' ? '✓ Copied' : 'Copy' }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="donation-note">
            <p><strong>Note:</strong> After making your donation, please send a confirmation to <a href="mailto:thebovenfoundation@gmail.com">thebovenfoundation@gmail.com</a> with your name and amount so we can acknowledge your contribution.</p>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<style scoped>
.donate-modal-backdrop {
  position: fixed;
  inset: 0;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1.5rem;
  background: rgba(0, 0, 0, 0.4);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  animation: donate-fade-in 0.25s var(--ease-out-quart);
}

@keyframes donate-fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}

.donate-modal {
  position: relative;
  width: 100%;
  max-width: 900px;
  max-height: calc(100vh - 3rem);
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 24px 48px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  animation: donate-scale-in 0.3s var(--ease-out-quart);
}

@keyframes donate-scale-in {
  from {
    opacity: 0;
    transform: scale(0.96);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.donate-modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  z-index: 2;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--color-bg-alt);
  border: none;
  border-radius: 10px;
  color: var(--color-body);
  cursor: pointer;
  transition: background var(--duration-fast), color var(--duration-fast);
}

.donate-modal-close:hover {
  background: var(--color-border);
  color: var(--color-primary);
}

.donate-modal-close svg {
  width: 20px;
  height: 20px;
}

.donate-modal-content {
  padding: 2rem 2rem 2.5rem;
  overflow-y: auto;
  max-height: calc(100vh - 3rem);
}

.donate-header {
  text-align: center;
  margin-bottom: 2rem;
  padding-right: 2.5rem;
}

.donate-title {
  font-family: var(--font-heading);
  font-size: clamp(1.75rem, 3vw, 2.25rem);
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 0.5rem;
  letter-spacing: -0.02em;
}

.donate-subtitle {
  font-size: 1rem;
  color: var(--color-body-muted);
  margin: 0;
  line-height: 1.6;
}

.payment-methods {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.payment-card {
  background: var(--color-bg-alt);
  border: 1px solid var(--color-border);
  border-radius: 16px;
  padding: 1.5rem;
  transition: border-color var(--duration-fast);
}

.payment-card:hover {
  border-color: rgba(13, 92, 26, 0.25);
}

.payment-icon {
  width: 56px;
  height: 56px;
  margin: 0 auto 0.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
}

.payment-icon svg {
  width: 100%;
  height: 100%;
}

.payment-title {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 0.25rem;
  text-align: center;
}

.payment-desc {
  text-align: center;
  color: var(--color-body-muted);
  margin: 0 0 1rem;
  font-size: 0.875rem;
}

.payment-details {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.detail-row {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.detail-label {
  font-weight: 600;
  color: var(--color-body);
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.detail-value-group {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 0.75rem;
  padding: 0.5rem 0.75rem;
  background: #fff;
  border-radius: 8px;
  border: 1px solid var(--color-border);
}

.detail-value {
  font-family: 'Courier New', monospace;
  font-size: 0.9375rem;
  font-weight: 600;
  color: var(--color-primary);
  flex: 1;
  word-break: break-all;
}

.copy-btn {
  background: var(--color-primary);
  color: #fff;
  border: none;
  padding: 0.4rem 0.75rem;
  border-radius: 6px;
  font-weight: 600;
  font-size: 0.8125rem;
  cursor: pointer;
  transition: background var(--duration-fast);
  white-space: nowrap;
}

.copy-btn:hover {
  background: var(--color-primary-dark);
}

.copy-btn.copied {
  background: #22c55e;
}

.donation-note {
  background: rgba(13, 92, 26, 0.06);
  border-left: 4px solid var(--color-primary);
  padding: 1rem 1.25rem;
  border-radius: 8px;
}

.donation-note p {
  margin: 0;
  color: var(--color-body);
  line-height: 1.6;
  font-size: 0.875rem;
}

.donation-note a {
  color: var(--color-primary);
  font-weight: 600;
  text-decoration: none;
}

.donation-note a:hover {
  text-decoration: underline;
}

@media (max-width: 640px) {
  .donate-modal-backdrop {
    padding: 0.75rem;
    align-items: flex-start;
  }

  .donate-modal {
    max-height: calc(100vh - 1.5rem);
  }

  .donate-modal-content {
    padding: 1.5rem 1.25rem 2rem;
  }

  .donate-modal-close {
    top: 0.75rem;
    right: 0.75rem;
    width: 36px;
    height: 36px;
  }

  .donate-header {
    padding-right: 2.25rem;
    margin-bottom: 1.5rem;
  }

  .donate-title {
    font-size: 1.5rem;
  }

  .payment-methods {
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }

  .detail-value-group {
    flex-direction: column;
    align-items: stretch;
  }

  .copy-btn {
    width: 100%;
  }
}
</style>
