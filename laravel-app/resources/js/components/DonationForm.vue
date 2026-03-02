<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';

const emit = defineEmits(['close', 'success']);

const formData = ref({
  name: '',
  phone: '',
  email: '',
  amount: '',
  payment_method: '',
  transaction_reference: '',
  payment_date: new Date().toISOString().split('T')[0],
  notes: ''
});

const errors = ref({});
const isSubmitting = ref(false);
const showForm = ref(false);

const paymentMethods = [
  { value: 'bank_transfer', label: 'Bank Transfer' },
  { value: 'mtn_mobile_money', label: 'MTN Mobile Money' },
  { value: 'telecel_cash', label: 'Telecel Cash' },
  { value: 'atmoney', label: 'ATMoney' }
];

const toggleForm = () => {
  showForm.value = !showForm.value;
};

const validateForm = () => {
  errors.value = {};
  
  if (!formData.value.name.trim()) {
    errors.value.name = 'Name is required';
  }
  
  if (!formData.value.phone.trim()) {
    errors.value.phone = 'Phone number is required';
  } else if (!/^[0-9+\-\s()]+$/.test(formData.value.phone)) {
    errors.value.phone = 'Please enter a valid phone number';
  }
  
  if (formData.value.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.value.email)) {
    errors.value.email = 'Please enter a valid email address';
  }
  
  if (!formData.value.amount || parseFloat(formData.value.amount) <= 0) {
    errors.value.amount = 'Please enter a valid donation amount';
  }
  
  if (!formData.value.payment_method) {
    errors.value.payment_method = 'Please select a payment method';
  }
  
  return Object.keys(errors.value).length === 0;
};

const submitForm = async () => {
  if (!validateForm()) {
    return;
  }
  
  isSubmitting.value = true;
  
  try {
    const response = await axios.post('/donations', {
      ...formData.value,
      amount: parseFloat(formData.value.amount)
    });
    
    emit('success', response.data);
    
    // Reset form
    formData.value = {
      name: '',
      phone: '',
      email: '',
      amount: '',
      payment_method: '',
      transaction_reference: '',
      payment_date: new Date().toISOString().split('T')[0],
      notes: ''
    };
    
    showForm.value = false;
  } catch (error) {
    if (error.response?.data?.errors) {
      errors.value = error.response.data.errors;
    } else {
      errors.value.submit = error.response?.data?.message || 'Something went wrong. Please try again.';
    }
  } finally {
    isSubmitting.value = false;
  }
};

const closeForm = () => {
  showForm.value = false;
  emit('close');
};
</script>

<template>
  <div class="donation-form-wrapper">
    <button 
      v-if="!showForm" 
      @click="toggleForm" 
      class="confirm-donation-btn"
      type="button"
    >
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
        <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span>Confirm Your Donation</span>
      <p class="btn-subtext">Fill out this form after completing your payment</p>
    </button>

    <div v-if="showForm" class="donation-form-container">
      <div class="form-header">
        <h3 class="form-title">Donation Confirmation</h3>
        <p class="form-subtitle">Please provide your details to confirm your donation</p>
        <button @click="closeForm" class="form-close-btn" type="button" aria-label="Close form">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>

      <form @submit.prevent="submitForm" class="donation-form">
        <div class="form-group">
          <label for="name" class="form-label">
            Full Name <span class="required">*</span>
          </label>
          <input
            id="name"
            v-model="formData.name"
            type="text"
            class="form-input"
            :class="{ 'error': errors.name }"
            placeholder="Enter your full name"
            required
          />
          <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
        </div>

        <div class="form-group">
          <label for="phone" class="form-label">
            Phone Number <span class="required">*</span>
          </label>
          <input
            id="phone"
            v-model="formData.phone"
            type="tel"
            class="form-input"
            :class="{ 'error': errors.phone }"
            placeholder="e.g., 0244 123 4567"
            required
          />
          <span v-if="errors.phone" class="error-message">{{ errors.phone }}</span>
        </div>

        <div class="form-group">
          <label for="email" class="form-label">
            Email Address <span class="optional">(Optional)</span>
          </label>
          <input
            id="email"
            v-model="formData.email"
            type="email"
            class="form-input"
            :class="{ 'error': errors.email }"
            placeholder="your.email@example.com"
          />
          <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="amount" class="form-label">
              Donation Amount (GHS) <span class="required">*</span>
            </label>
            <input
              id="amount"
              v-model="formData.amount"
              type="number"
              step="0.01"
              min="0.01"
              class="form-input"
              :class="{ 'error': errors.amount }"
              placeholder="0.00"
              required
            />
            <span v-if="errors.amount" class="error-message">{{ errors.amount }}</span>
          </div>

          <div class="form-group">
            <label for="payment_method" class="form-label">
              Payment Method <span class="required">*</span>
            </label>
            <select
              id="payment_method"
              v-model="formData.payment_method"
              class="form-select"
              :class="{ 'error': errors.payment_method }"
              required
            >
              <option value="">Select payment method</option>
              <option v-for="method in paymentMethods" :key="method.value" :value="method.value">
                {{ method.label }}
              </option>
            </select>
            <span v-if="errors.payment_method" class="error-message">{{ errors.payment_method }}</span>
          </div>
        </div>

        <div class="form-group">
          <label for="transaction_reference" class="form-label">
            Transaction Reference <span class="optional">(Optional)</span>
          </label>
          <input
            id="transaction_reference"
            v-model="formData.transaction_reference"
            type="text"
            class="form-input"
            placeholder="Transaction ID or reference number"
          />
          <p class="form-hint">Help us track your payment more easily</p>
        </div>

        <div class="form-group">
          <label for="payment_date" class="form-label">
            Payment Date <span class="required">*</span>
          </label>
          <input
            id="payment_date"
            v-model="formData.payment_date"
            type="date"
            class="form-input"
            required
          />
        </div>

        <div class="form-group">
          <label for="notes" class="form-label">
            Additional Notes <span class="optional">(Optional)</span>
          </label>
          <textarea
            id="notes"
            v-model="formData.notes"
            class="form-textarea"
            rows="3"
            placeholder="Any additional information you'd like to share..."
          ></textarea>
        </div>

        <div v-if="errors.submit" class="form-error">
          {{ errors.submit }}
        </div>

        <div class="form-actions">
          <button type="button" @click="closeForm" class="btn-cancel">
            Cancel
          </button>
          <button type="submit" class="btn-submit" :disabled="isSubmitting">
            <span v-if="isSubmitting">Submitting...</span>
            <span v-else>Confirm Donation</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
.donation-form-wrapper {
  margin-top: 2rem;
}

.confirm-donation-btn {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  padding: 1.5rem 2rem;
  background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
  color: #fff;
  border: none;
  border-radius: 16px;
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 1.125rem;
  cursor: pointer;
  transition: all 0.3s var(--ease-out-quart);
  box-shadow: 0 4px 16px rgba(13, 92, 26, 0.25);
}

.confirm-donation-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(13, 92, 26, 0.35);
}

.confirm-donation-btn svg {
  flex-shrink: 0;
}

.confirm-donation-btn .btn-subtext {
  font-family: var(--font-sans);
  font-weight: 400;
  font-size: 0.875rem;
  opacity: 0.9;
  margin: 0;
}

.donation-form-container {
  background: #fff;
  border: 2px solid rgba(13, 92, 26, 0.1);
  border-radius: 20px;
  padding: 2rem;
  animation: form-slide-in 0.3s var(--ease-out-quart);
}

@keyframes form-slide-in {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.form-header {
  position: relative;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid var(--color-border);
}

.form-title {
  font-family: var(--font-heading);
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--color-primary);
  margin: 0 0 0.5rem;
  letter-spacing: -0.02em;
}

.form-subtitle {
  color: var(--color-body-muted);
  margin: 0;
  font-size: 0.9375rem;
}

.form-close-btn {
  position: absolute;
  top: 0;
  right: 0;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--color-bg-alt);
  border: none;
  border-radius: 8px;
  color: var(--color-body);
  cursor: pointer;
  transition: all var(--duration-fast);
}

.form-close-btn:hover {
  background: var(--color-border);
  color: var(--color-primary);
}

.form-close-btn svg {
  width: 18px;
  height: 18px;
}

.donation-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-label {
  font-weight: 600;
  color: var(--color-body);
  font-size: 0.875rem;
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.required {
  color: #dc2626;
}

.optional {
  color: var(--color-body-muted);
  font-weight: 400;
  font-size: 0.8125rem;
}

.form-input,
.form-select,
.form-textarea {
  padding: 0.75rem 1rem;
  border: 2px solid var(--color-border);
  border-radius: 10px;
  font-family: var(--font-sans);
  font-size: 0.9375rem;
  color: var(--color-body);
  background: #fff;
  transition: all var(--duration-fast);
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
  outline: none;
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px rgba(13, 92, 26, 0.1);
}

.form-input.error,
.form-select.error,
.form-textarea.error {
  border-color: #dc2626;
}

.form-input.error:focus,
.form-select.error:focus,
.form-textarea.error:focus {
  box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

.form-textarea {
  resize: vertical;
  min-height: 80px;
}

.form-hint {
  font-size: 0.8125rem;
  color: var(--color-body-muted);
  margin: 0;
}

.error-message {
  font-size: 0.8125rem;
  color: #dc2626;
  margin-top: -0.25rem;
}

.form-error {
  padding: 0.75rem 1rem;
  background: #fef2f2;
  border: 1px solid #fecaca;
  border-radius: 8px;
  color: #dc2626;
  font-size: 0.875rem;
}

.form-actions {
  display: flex;
  gap: 1rem;
  margin-top: 0.5rem;
}

.btn-cancel {
  flex: 1;
  padding: 0.875rem 1.5rem;
  background: transparent;
  border: 2px solid var(--color-border);
  border-radius: 10px;
  color: var(--color-body);
  font-weight: 600;
  font-size: 0.9375rem;
  cursor: pointer;
  transition: all var(--duration-fast);
}

.btn-cancel:hover {
  border-color: var(--color-body-muted);
  background: var(--color-bg-alt);
}

.btn-submit {
  flex: 2;
  padding: 0.875rem 1.5rem;
  background: var(--color-primary);
  border: none;
  border-radius: 10px;
  color: #fff;
  font-weight: 600;
  font-size: 0.9375rem;
  cursor: pointer;
  transition: all var(--duration-fast);
}

.btn-submit:hover:not(:disabled) {
  background: var(--color-primary-dark);
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(13, 92, 26, 0.3);
}

.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

@media (max-width: 768px) {
  .donation-form-container {
    padding: 1.5rem;
  }

  .form-row {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .form-actions {
    flex-direction: column;
  }

  .btn-cancel,
  .btn-submit {
    flex: 1;
  }
}
</style>
