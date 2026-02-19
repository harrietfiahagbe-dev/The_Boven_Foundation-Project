<script setup>
import { ref, inject } from 'vue';
import NavBar from './NavBar.vue';
import FooterSection from './FooterSection.vue';

const navigate = inject('navigate', null);
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

function goBack() {
  if (navigate) {
    navigate('home');
  } else {
    window.history.back();
  }
}
</script>

<template>
  <div class="donate-page">
    <NavBar />
    <main class="donate-main">
      <div class="donate-container">
        <button @click="goBack" class="back-button">
          ← Back
        </button>
        
        <div class="donate-header">
          <h1 class="donate-title">Support Our Mission</h1>
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
                  <button 
                    @click="copyToClipboard('Ghana Commercial Bank (GCB)', 'bank')"
                    class="copy-btn"
                    :class="{ copied: copiedField === 'bank' }"
                  >
                    {{ copiedField === 'bank' ? '✓ Copied' : 'Copy' }}
                  </button>
                </div>
              </div>
              
              <div class="detail-row">
                <span class="detail-label">Account Name:</span>
                <div class="detail-value-group">
                  <span class="detail-value">The Boven Foundation</span>
                  <button 
                    @click="copyToClipboard('The Boven Foundation', 'account-name')"
                    class="copy-btn"
                    :class="{ copied: copiedField === 'account-name' }"
                  >
                    {{ copiedField === 'account-name' ? '✓ Copied' : 'Copy' }}
                  </button>
                </div>
              </div>
              
              <div class="detail-row">
                <span class="detail-label">Account Number:</span>
                <div class="detail-value-group">
                  <span class="detail-value">1234567890123</span>
                  <button 
                    @click="copyToClipboard('1234567890123', 'account-number')"
                    class="copy-btn"
                    :class="{ copied: copiedField === 'account-number' }"
                  >
                    {{ copiedField === 'account-number' ? '✓ Copied' : 'Copy' }}
                  </button>
                </div>
              </div>
              
              <div class="detail-row">
                <span class="detail-label">Branch:</span>
                <div class="detail-value-group">
                  <span class="detail-value">Elmina Branch</span>
                  <button 
                    @click="copyToClipboard('Elmina Branch', 'branch')"
                    class="copy-btn"
                    :class="{ copied: copiedField === 'branch' }"
                  >
                    {{ copiedField === 'branch' ? '✓ Copied' : 'Copy' }}
                  </button>
                </div>
              </div>
              
              <div class="detail-row">
                <span class="detail-label">SWIFT Code:</span>
                <div class="detail-value-group">
                  <span class="detail-value">GCBLGHAC</span>
                  <button 
                    @click="copyToClipboard('GCBLGHAC', 'swift')"
                    class="copy-btn"
                    :class="{ copied: copiedField === 'swift' }"
                  >
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
            <p class="payment-desc">Send money via MTN Mobile Money or Vodafone Cash</p>
            
            <div class="payment-details">
              <div class="detail-row">
                <span class="detail-label">MTN Mobile Money:</span>
                <div class="detail-value-group">
                  <span class="detail-value">0244 123 4567</span>
                  <button 
                    @click="copyToClipboard('02441234567', 'mtn')"
                    class="copy-btn"
                    :class="{ copied: copiedField === 'mtn' }"
                  >
                    {{ copiedField === 'mtn' ? '✓ Copied' : 'Copy' }}
                  </button>
                </div>
              </div>
              
              <div class="detail-row">
                <span class="detail-label">Vodafone Cash:</span>
                <div class="detail-value-group">
                  <span class="detail-value">0204 123 4567</span>
                  <button 
                    @click="copyToClipboard('02041234567', 'vodafone')"
                    class="copy-btn"
                    :class="{ copied: copiedField === 'vodafone' }"
                  >
                    {{ copiedField === 'vodafone' ? '✓ Copied' : 'Copy' }}
                  </button>
                </div>
              </div>
              
              <div class="detail-row">
                <span class="detail-label">AirtelTigo Money:</span>
                <div class="detail-value-group">
                  <span class="detail-value">0274 123 4567</span>
                  <button 
                    @click="copyToClipboard('02741234567', 'airteltigo')"
                    class="copy-btn"
                    :class="{ copied: copiedField === 'airteltigo' }"
                  >
                    {{ copiedField === 'airteltigo' ? '✓ Copied' : 'Copy' }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="donation-note">
          <p><strong>Note:</strong> After making your donation, please send us a confirmation message at <a href="mailto:thebovenfoundation@gmail.com">thebovenfoundation@gmail.com</a> with your name and donation amount so we can properly acknowledge your contribution.</p>
        </div>
      </div>
    </main>
    <FooterSection />
  </div>
</template>

<style scoped>
.donate-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
.donate-main {
  flex: 1;
  padding: 2rem 1.5rem 4rem;
  background: linear-gradient(180deg, #f8faf8 0%, #ffffff 100%);
}
.donate-container {
  max-width: 900px;
  margin: 0 auto;
}
.back-button {
  background: transparent;
  border: 2px solid var(--color-primary);
  color: var(--color-primary);
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.9375rem;
  cursor: pointer;
  transition: all var(--duration-fast);
  margin-bottom: 2rem;
}
.back-button:hover {
  background: var(--color-primary);
  color: #fff;
  transform: translateY(-1px);
}
.donate-header {
  text-align: center;
  margin-bottom: 3rem;
}
.donate-title {
  font-family: var(--font-heading);
  font-size: clamp(2rem, 4vw, 2.75rem);
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 1rem;
  letter-spacing: -0.02em;
}
.donate-subtitle {
  font-size: 1.125rem;
  color: var(--color-body-muted);
  margin: 0;
  line-height: 1.6;
}
.payment-methods {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-bottom: 2.5rem;
}
.payment-card {
  background: #ffffff;
  border: 1px solid rgba(27, 94, 32, 0.1);
  border-radius: 20px;
  padding: 2rem;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.payment-card:hover {
  transform: translateY(-4px);
  border-color: rgba(27, 94, 32, 0.2);
}
.payment-icon {
  width: 64px;
  height: 64px;
  margin: 0 auto 1rem;
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
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 0.5rem;
  text-align: center;
}
.payment-desc {
  text-align: center;
  color: var(--color-body-muted);
  margin: 0 0 1.5rem;
  font-size: 0.9375rem;
}
.payment-details {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
.detail-row {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
.detail-label {
  font-weight: 600;
  color: var(--color-body);
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.detail-value-group {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  padding: 0.75rem 1rem;
  background: var(--color-bg-alt);
  border-radius: 10px;
  border: 1px solid var(--color-border);
}
.detail-value {
  font-family: 'Courier New', monospace;
  font-size: 1rem;
  font-weight: 600;
  color: var(--color-primary);
  flex: 1;
  word-break: break-all;
}
.copy-btn {
  background: var(--color-primary);
  color: #fff;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  font-weight: 600;
  font-size: 0.875rem;
  cursor: pointer;
  transition: all var(--duration-fast);
  white-space: nowrap;
}
.copy-btn:hover {
  background: var(--color-primary-dark);
  transform: translateY(-1px);
}
.copy-btn.copied {
  background: #22c55e;
}
.donation-note {
  background: rgba(13, 92, 26, 0.05);
  border-left: 4px solid var(--color-primary);
  padding: 1.5rem;
  border-radius: 10px;
  margin-top: 2rem;
}
.donation-note p {
  margin: 0;
  color: var(--color-body);
  line-height: 1.7;
  font-size: 0.9375rem;
}
.donation-note a {
  color: var(--color-primary);
  font-weight: 600;
  text-decoration: none;
}
.donation-note a:hover {
  text-decoration: underline;
}
@media (max-width: 768px) {
  .donate-main {
    padding: 1.5rem 1.25rem 3rem;
  }
  .donate-title {
    font-size: 1.75rem;
  }
  .donate-subtitle {
    font-size: 1rem;
  }
  .payment-methods {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  .payment-card {
    padding: 1.5rem;
  }
  .payment-icon {
    width: 56px;
    height: 56px;
  }
  .payment-title {
    font-size: 1.25rem;
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
