<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import DonationForm from './DonationForm.vue';

const emit = defineEmits(['close']);
const copySuccess = ref('');
const copiedField = ref('');
const showSuccessMessage = ref(false);

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

function handleDonationSuccess(data) {
  showSuccessMessage.value = true;
  setTimeout(() => {
    showSuccessMessage.value = false;
  }, 10000);
}

function handleFormClose() {
  // Form closed, do nothing
}
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
            <div class="donate-icon-wrapper">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </div>
            <h1 id="donate-modal-title" class="donate-title">Support Our Mission</h1>
            <p class="donate-subtitle">Your contribution helps us provide STEM education to underserved youth in Ghana</p>
          </div>

          <div class="payment-methods">
            <!-- Bank Transfer -->
            <div class="payment-card">
              <div class="payment-card-header">
                <div class="payment-icon-wrapper">
                  <div class="payment-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="2" y="8" width="20" height="12" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                      <path d="M2 12H22" stroke="currentColor" stroke-width="1.5"/>
                      <path d="M6 16H8M10 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      <path d="M4 4L12 2L20 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                  </div>
                </div>
                <h2 class="payment-title">Bank Transfer</h2>
                <p class="payment-desc">Transfer directly to our bank account</p>
              </div>
              <div class="payment-details">
                <div class="detail-row">
                  <span class="detail-label">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                      <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                    Bank Name
                  </span>
                  <div class="detail-value-group">
                    <span class="detail-value">Ghana Commercial Bank (GCB)</span>
                    <button type="button" @click="copyToClipboard('Ghana Commercial Bank (GCB)', 'bank')" class="copy-btn" :class="{ copied: copiedField === 'bank' }">
                      <svg v-if="copiedField !== 'bank'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      </svg>
                      <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>{{ copiedField === 'bank' ? 'Copied' : 'Copy' }}</span>
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                      <path d="M20 21H4C2.89543 21 2 20.1046 2 19V5C2 3.89543 2.89543 3 4 3H20C21.1046 3 22 3.89543 22 5V19C22 20.1046 21.1046 21 20 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      <path d="M7 8H17M7 12H17M7 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Account Name
                  </span>
                  <div class="detail-value-group">
                    <span class="detail-value">The Boven Foundation</span>
                    <button type="button" @click="copyToClipboard('The Boven Foundation', 'account-name')" class="copy-btn" :class="{ copied: copiedField === 'account-name' }">
                      <svg v-if="copiedField !== 'account-name'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      </svg>
                      <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>{{ copiedField === 'account-name' ? 'Copied' : 'Copy' }}</span>
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                      <rect x="3" y="6" width="18" height="12" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                      <path d="M3 10H21" stroke="currentColor" stroke-width="1.5"/>
                      <path d="M7 14H9M11 14H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Account Number
                  </span>
                  <div class="detail-value-group">
                    <span class="detail-value">1234567890123</span>
                    <button type="button" @click="copyToClipboard('1234567890123', 'account-number')" class="copy-btn" :class="{ copied: copiedField === 'account-number' }">
                      <svg v-if="copiedField !== 'account-number'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      </svg>
                      <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>{{ copiedField === 'account-number' ? 'Copied' : 'Copy' }}</span>
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                      <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                      <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/>
                    </svg>
                    Branch
                  </span>
                  <div class="detail-value-group">
                    <span class="detail-value">Elmina Branch</span>
                    <button type="button" @click="copyToClipboard('Elmina Branch', 'branch')" class="copy-btn" :class="{ copied: copiedField === 'branch' }">
                      <svg v-if="copiedField !== 'branch'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      </svg>
                      <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>{{ copiedField === 'branch' ? 'Copied' : 'Copy' }}</span>
                    </button>
                  </div>
                </div>
                <div class="detail-row">
                  <span class="detail-label">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                      <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                    SWIFT Code
                  </span>
                  <div class="detail-value-group">
                    <span class="detail-value">GCBLGHAC</span>
                    <button type="button" @click="copyToClipboard('GCBLGHAC', 'swift')" class="copy-btn" :class="{ copied: copiedField === 'swift' }">
                      <svg v-if="copiedField !== 'swift'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      </svg>
                      <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>{{ copiedField === 'swift' ? 'Copied' : 'Copy' }}</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Mobile Money -->
            <div class="payment-card">
              <div class="payment-card-header">
                <div class="payment-icon-wrapper">
                  <div class="payment-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="5" y="2" width="14" height="20" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                      <path d="M9 6H15M9 10H15M9 14H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      <circle cx="12" cy="18" r="1" fill="currentColor"/>
                    </svg>
                  </div>
                </div>
                <h2 class="payment-title">Mobile Money</h2>
                <p class="payment-desc">Send via MTN Mobile Money, Telecel Cash, or ATMoney</p>
              </div>
              <div class="payment-details">
                <!-- MTN -->
                <div class="mobile-money-group">
                  <div class="mobile-money-provider">
                    <span class="provider-badge mtn">MTN Mobile Money</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">
                      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7292C21.7209 20.9841 21.5573 21.2131 21.352 21.4016C21.1467 21.5901 20.9041 21.7341 20.6397 21.8242C20.3753 21.9143 20.0952 21.9486 19.816 21.9246C19.5368 21.9006 19.2647 21.8187 19.018 21.684L16.62 20.354C16.2193 20.1354 15.7707 20.0242 15.314 20.03H8.5C7.57174 20.03 6.6815 19.6632 6.02513 19.0069C5.36875 18.3505 5.00196 17.4603 5.00196 16.532V7.468C5.00196 6.53974 5.36875 5.6495 6.02513 4.99313C6.6815 4.33675 7.57174 3.96997 8.5 3.96997H15.5C16.4283 3.96997 17.3185 4.33675 17.9749 4.99313C18.6312 5.6495 18.998 6.53974 18.998 7.468V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <path d="M12 11V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M16 8V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      </svg>
                      Number
                    </span>
                    <div class="detail-value-group">
                      <span class="detail-value">0244 123 4567</span>
                      <button type="button" @click="copyToClipboard('02441234567', 'mtn')" class="copy-btn" :class="{ copied: copiedField === 'mtn' }">
                        <svg v-if="copiedField !== 'mtn'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                          <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                        <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ copiedField === 'mtn' ? 'Copied' : 'Copy' }}</span>
                      </button>
                    </div>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">
                      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M20 21H4C2.89543 21 2 20.1046 2 19V5C2 3.89543 2.89543 3 4 3H20C21.1046 3 22 3.89543 22 5V19C22 20.1046 21.1046 21 20 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <path d="M7 8H17M7 12H17M7 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      </svg>
                      Name
                    </span>
                    <div class="detail-value-group">
                      <span class="detail-value">The Boven Foundation</span>
                      <button type="button" @click="copyToClipboard('The Boven Foundation', 'mtn-name')" class="copy-btn" :class="{ copied: copiedField === 'mtn-name' }">
                        <svg v-if="copiedField !== 'mtn-name'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                          <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                        <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ copiedField === 'mtn-name' ? 'Copied' : 'Copy' }}</span>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Vodafone -->
                <div class="mobile-money-group">
                  <div class="mobile-money-provider">
                    <span class="provider-badge vodafone">Telecel Cash</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">
                      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7292C21.7209 20.9841 21.5573 21.2131 21.352 21.4016C21.1467 21.5901 20.9041 21.7341 20.6397 21.8242C20.3753 21.9143 20.0952 21.9486 19.816 21.9246C19.5368 21.9006 19.2647 21.8187 19.018 21.684L16.62 20.354C16.2193 20.1354 15.7707 20.0242 15.314 20.03H8.5C7.57174 20.03 6.6815 19.6632 6.02513 19.0069C5.36875 18.3505 5.00196 17.4603 5.00196 16.532V7.468C5.00196 6.53974 5.36875 5.6495 6.02513 4.99313C6.6815 4.33675 7.57174 3.96997 8.5 3.96997H15.5C16.4283 3.96997 17.3185 4.33675 17.9749 4.99313C18.6312 5.6495 18.998 6.53974 18.998 7.468V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <path d="M12 11V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M16 8V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      </svg>
                      Number
                    </span>
                    <div class="detail-value-group">
                      <span class="detail-value">0204 123 4567</span>
                      <button type="button" @click="copyToClipboard('02041234567', 'vodafone')" class="copy-btn" :class="{ copied: copiedField === 'vodafone' }">
                        <svg v-if="copiedField !== 'vodafone'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                          <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                        <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ copiedField === 'vodafone' ? 'Copied' : 'Copy' }}</span>
                      </button>
                    </div>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">
                      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M20 21H4C2.89543 21 2 20.1046 2 19V5C2 3.89543 2.89543 3 4 3H20C21.1046 3 22 3.89543 22 5V19C22 20.1046 21.1046 21 20 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <path d="M7 8H17M7 12H17M7 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      </svg>
                      Name
                    </span>
                    <div class="detail-value-group">
                      <span class="detail-value">The Boven Foundation</span>
                      <button type="button" @click="copyToClipboard('The Boven Foundation', 'vodafone-name')" class="copy-btn" :class="{ copied: copiedField === 'vodafone-name' }">
                        <svg v-if="copiedField !== 'vodafone-name'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                          <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                        <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ copiedField === 'vodafone-name' ? 'Copied' : 'Copy' }}</span>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- AirtelTigo -->
                <div class="mobile-money-group">
                  <div class="mobile-money-provider">
                    <span class="provider-badge airteltigo">ATMoney</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">
                      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7292C21.7209 20.9841 21.5573 21.2131 21.352 21.4016C21.1467 21.5901 20.9041 21.7341 20.6397 21.8242C20.3753 21.9143 20.0952 21.9486 19.816 21.9246C19.5368 21.9006 19.2647 21.8187 19.018 21.684L16.62 20.354C16.2193 20.1354 15.7707 20.0242 15.314 20.03H8.5C7.57174 20.03 6.6815 19.6632 6.02513 19.0069C5.36875 18.3505 5.00196 17.4603 5.00196 16.532V7.468C5.00196 6.53974 5.36875 5.6495 6.02513 4.99313C6.6815 4.33675 7.57174 3.96997 8.5 3.96997H15.5C16.4283 3.96997 17.3185 4.33675 17.9749 4.99313C18.6312 5.6495 18.998 6.53974 18.998 7.468V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <path d="M12 11V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M16 8V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      </svg>
                      Number
                    </span>
                    <div class="detail-value-group">
                      <span class="detail-value">0274 123 4567</span>
                      <button type="button" @click="copyToClipboard('02741234567', 'airteltigo')" class="copy-btn" :class="{ copied: copiedField === 'airteltigo' }">
                        <svg v-if="copiedField !== 'airteltigo'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                          <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                        <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ copiedField === 'airteltigo' ? 'Copied' : 'Copy' }}</span>
                      </button>
                    </div>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">
                      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M20 21H4C2.89543 21 2 20.1046 2 19V5C2 3.89543 2.89543 3 4 3H20C21.1046 3 22 3.89543 22 5V19C22 20.1046 21.1046 21 20 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <path d="M7 8H17M7 12H17M7 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      </svg>
                      Name
                    </span>
                    <div class="detail-value-group">
                      <span class="detail-value">The Boven Foundation</span>
                      <button type="button" @click="copyToClipboard('The Boven Foundation', 'airteltigo-name')" class="copy-btn" :class="{ copied: copiedField === 'airteltigo-name' }">
                        <svg v-if="copiedField !== 'airteltigo-name'" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                          <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                        <svg v-else viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                          <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ copiedField === 'airteltigo-name' ? 'Copied' : 'Copy' }}</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <DonationForm @success="handleDonationSuccess" @close="handleFormClose" />

          <div v-if="showSuccessMessage" class="success-message">
            <div class="success-icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div class="success-content">
              <h4>Thank You!</h4>
              <p>Your donation confirmation has been received. We appreciate your support!</p>
            </div>
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
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  animation: donate-fade-in 0.3s var(--ease-out-quart);
}

@keyframes donate-fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}

.donate-modal {
  position: relative;
  width: 100%;
  max-width: 920px;
  max-height: calc(100vh - 3rem);
  background: #fff;
  border-radius: 24px;
  box-shadow: 0 32px 64px rgba(0, 0, 0, 0.25);
  overflow: hidden;
  animation: donate-scale-in 0.35s var(--ease-out-expo);
}

@keyframes donate-scale-in {
  from {
    opacity: 0;
    transform: scale(0.94) translateY(20px);
  }
  to {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}

.donate-modal-close {
  position: absolute;
  top: 1.25rem;
  right: 1.25rem;
  z-index: 2;
  width: 44px;
  height: 44px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(13, 92, 26, 0.08);
  border: none;
  border-radius: 12px;
  color: var(--color-body);
  cursor: pointer;
  transition: all var(--duration-fast);
}

.donate-modal-close:hover {
  background: rgba(13, 92, 26, 0.15);
  color: var(--color-primary);
  transform: rotate(90deg);
}

.donate-modal-close svg {
  width: 20px;
  height: 20px;
}

.donate-modal-content {
  padding: 2.5rem 2.5rem 2.75rem;
  overflow-y: auto;
  max-height: calc(100vh - 3rem);
}

.donate-header {
  text-align: center;
  margin-bottom: 2.5rem;
  padding-right: 3rem;
}

.donate-icon-wrapper {
  width: 72px;
  height: 72px;
  margin: 0 auto 1.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, rgba(13, 92, 26, 0.1) 0%, rgba(13, 92, 26, 0.05) 100%);
  border-radius: 20px;
  color: var(--color-primary);
}

.donate-icon-wrapper svg {
  width: 36px;
  height: 36px;
}

.donate-title {
  font-family: var(--font-heading);
  font-size: clamp(1.875rem, 3.5vw, 2.5rem);
  font-weight: 800;
  color: var(--color-primary);
  margin: 0 0 0.75rem;
  letter-spacing: -0.03em;
}

.donate-subtitle {
  font-size: 1.0625rem;
  color: var(--color-body-muted);
  margin: 0;
  line-height: 1.65;
  font-weight: 500;
}

.payment-methods {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-bottom: 2.5rem;
}

.payment-card {
  background: linear-gradient(135deg, #ffffff 0%, rgba(248, 250, 248, 0.5) 100%);
  border: 2px solid rgba(13, 92, 26, 0.1);
  border-radius: 20px;
  padding: 2rem;
  transition: all 0.4s var(--ease-out-quart);
  position: relative;
  overflow: hidden;
}

.payment-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.4s var(--ease-out-quart);
}

.payment-card:hover {
  border-color: rgba(13, 92, 26, 0.25);
  transform: translateY(-4px);
  box-shadow: 0 20px 48px rgba(13, 92, 26, 0.12);
}

.payment-card:hover::before {
  transform: scaleX(1);
}

.payment-card-header {
  text-align: center;
  margin-bottom: 1.75rem;
}

.payment-icon-wrapper {
  width: 64px;
  height: 64px;
  margin: 0 auto 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, rgba(13, 92, 26, 0.12) 0%, rgba(13, 92, 26, 0.06) 100%);
  border-radius: 16px;
  color: var(--color-primary);
  transition: transform 0.3s var(--ease-out-quart);
}

.payment-card:hover .payment-icon-wrapper {
  transform: scale(1.05) rotate(2deg);
}

.payment-icon {
  width: 32px;
  height: 32px;
}

.payment-icon svg {
  width: 100%;
  height: 100%;
}

.payment-title {
  font-family: var(--font-heading);
  font-size: 1.375rem;
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 0.5rem;
  letter-spacing: -0.02em;
}

.payment-desc {
  text-align: center;
  color: var(--color-body-muted);
  margin: 0;
  font-size: 0.9375rem;
  font-weight: 500;
}

.payment-details {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.mobile-money-group {
  padding: 1rem;
  background: rgba(13, 92, 26, 0.03);
  border-radius: 12px;
  border: 1px solid rgba(13, 92, 26, 0.08);
  margin-bottom: 0.5rem;
}

.mobile-money-group:last-child {
  margin-bottom: 0;
}

.mobile-money-provider {
  margin-bottom: 0.75rem;
}

.provider-badge {
  display: inline-block;
  padding: 0.35rem 0.875rem;
  border-radius: 8px;
  font-weight: 700;
  font-size: 0.75rem;
  letter-spacing: 0.05em;
  text-transform: uppercase;
}

.provider-badge.mtn {
  background: linear-gradient(135deg, #ffcc00 0%, #ff9900 100%);
  color: #1a1f1a;
}

.provider-badge.vodafone {
  background: linear-gradient(135deg, #e60000 0%, #cc0000 100%);
  color: #fff;
}

.provider-badge.airteltigo {
  background: linear-gradient(135deg, #E60012 0%, #0066CC 100%);
  color: #fff;
}

.detail-row {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.detail-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 600;
  color: var(--color-body);
  font-size: 0.8125rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.detail-label svg {
  color: var(--color-primary);
  flex-shrink: 0;
}

.detail-value-group {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  background: #fff;
  border-radius: 12px;
  border: 2px solid rgba(13, 92, 26, 0.1);
  transition: border-color var(--duration-fast), box-shadow var(--duration-fast);
  min-width: 0;
  width: 100%;
}

.detail-value-group:hover {
  border-color: rgba(13, 92, 26, 0.2);
  box-shadow: 0 2px 8px rgba(13, 92, 26, 0.08);
}

.detail-value {
  font-family: 'Courier New', monospace;
  font-size: 0.9375rem;
  font-weight: 600;
  color: var(--color-primary);
  flex: 1;
  min-width: 0;
  word-break: break-word;
  overflow-wrap: break-word;
}

.copy-btn {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  background: var(--color-primary);
  color: #fff;
  border: none;
  padding: 0.5rem 0.875rem;
  border-radius: 10px;
  font-weight: 600;
  font-size: 0.8125rem;
  cursor: pointer;
  transition: all 0.25s var(--ease-out-quart);
  white-space: nowrap;
}

.copy-btn:hover {
  background: var(--color-primary-dark);
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(13, 92, 26, 0.25);
}

.copy-btn.copied {
  background: #22c55e;
  animation: copy-success 0.4s var(--ease-out-quart);
}

@keyframes copy-success {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.copy-btn svg {
  flex-shrink: 0;
}


.success-message {
  display: flex;
  gap: 1rem;
  background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%);
  border: 2px solid #22c55e;
  border-radius: 14px;
  padding: 1.25rem 1.5rem;
  margin-bottom: 1.5rem;
  animation: success-fade-in 0.4s var(--ease-out-quart);
}

@keyframes success-fade-in {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.success-icon {
  flex-shrink: 0;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #22c55e;
  border-radius: 8px;
  color: #fff;
}

.success-icon svg {
  width: 18px;
  height: 18px;
}

.success-content h4 {
  font-family: var(--font-heading);
  font-size: 1.125rem;
  font-weight: 700;
  color: #16a34a;
  margin: 0 0 0.25rem;
}

.success-content p {
  margin: 0;
  color: var(--color-body);
  font-size: 0.9375rem;
  line-height: 1.6;
}

@media (max-width: 768px) {
  .donate-modal-backdrop {
    padding: 0.75rem;
    align-items: flex-start;
  }

  .donate-modal {
    max-height: calc(100vh - 1.5rem);
    border-radius: 20px;
  }

  .donate-modal-content {
    padding: 1.75rem 1.5rem 2rem;
  }

  .donate-modal-close {
    top: 1rem;
    right: 1rem;
    width: 40px;
    height: 40px;
  }

  .donate-header {
    padding-right: 2.5rem;
    margin-bottom: 2rem;
  }

  .donate-icon-wrapper {
    width: 64px;
    height: 64px;
    margin-bottom: 1rem;
  }

  .donate-icon-wrapper svg {
    width: 32px;
    height: 32px;
  }

  .donate-title {
    font-size: 1.625rem;
  }

  .donate-subtitle {
    font-size: 0.9375rem;
  }

  .payment-methods {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .payment-card {
    padding: 1.5rem;
  }

  .payment-icon-wrapper {
    width: 56px;
    height: 56px;
  }

  .payment-title {
    font-size: 1.25rem;
  }

  .detail-value-group {
    flex-direction: column;
    align-items: stretch;
    gap: 0.5rem;
  }

  .copy-btn {
    width: 100%;
    justify-content: center;
  }

}
</style>
