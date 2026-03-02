<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const donations = ref([]);
const loading = ref(true);
const error = ref('');

const paymentMethodLabels = {
  'bank_transfer': 'Bank Transfer',
  'mtn_mobile_money': 'MTN Mobile Money',
  'telecel_cash': 'Telecel Cash',
  'atmoney': 'ATMoney'
};

async function fetchDonations() {
  loading.value = true;
  error.value = '';
  try {
    const { data } = await axios.get('/donations');
    donations.value = data;
  } catch (e) {
    error.value = 'Failed to load donations. Please refresh the page.';
    console.error(e);
  } finally {
    loading.value = false;
  }
}

function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
}

function formatAmount(amount) {
  return new Intl.NumberFormat('en-GH', {
    style: 'currency',
    currency: 'GHS',
    minimumFractionDigits: 2
  }).format(amount);
}

onMounted(() => {
  fetchDonations();
});
</script>

<template>
  <div class="donations-admin">
    <div class="admin-header">
      <h1 class="admin-title">Donations Dashboard</h1>
      <button @click="fetchDonations" class="refresh-btn" :disabled="loading">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
          <path d="M1 4V10H7M23 20V14H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10M23 14L18.36 18.36A9 9 0 0 1 3.51 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        {{ loading ? 'Loading...' : 'Refresh' }}
      </button>
    </div>

    <div v-if="error" class="error-banner">
      {{ error }}
    </div>

    <div v-if="loading && donations.length === 0" class="loading-state">
      <p>Loading donations...</p>
    </div>

    <div v-else-if="donations.length === 0" class="empty-state">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="64" height="64">
        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      </svg>
      <h3>No Donations Yet</h3>
      <p>Donations will appear here once donors submit the confirmation form.</p>
    </div>

    <div v-else class="donations-stats">
      <div class="stat-card">
        <div class="stat-value">{{ donations.length }}</div>
        <div class="stat-label">Total Donations</div>
      </div>
      <div class="stat-card">
        <div class="stat-value">{{ formatAmount(donations.reduce((sum, d) => sum + parseFloat(d.amount), 0)) }}</div>
        <div class="stat-label">Total Amount</div>
      </div>
      <div class="stat-card">
        <div class="stat-value">{{ donations.filter(d => d.email).length }}</div>
        <div class="stat-label">With Email</div>
      </div>
    </div>

    <div v-if="donations.length > 0" class="donations-table-wrapper">
      <table class="donations-table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Donor Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Reference</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="donation in donations" :key="donation.id">
            <td>{{ formatDate(donation.created_at) }}</td>
            <td class="donor-name">{{ donation.name }}</td>
            <td>{{ donation.phone }}</td>
            <td>{{ donation.email || '—' }}</td>
            <td class="amount">{{ formatAmount(donation.amount) }}</td>
            <td>
              <span class="payment-badge">{{ paymentMethodLabels[donation.payment_method] || donation.payment_method }}</span>
            </td>
            <td>{{ donation.transaction_reference || '—' }}</td>
            <td>
              <span :class="['status-badge', donation.acknowledged ? 'acknowledged' : 'pending']">
                {{ donation.acknowledged ? '✓ Acknowledged' : 'Pending' }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
.donations-admin {
  max-width: 1400px;
  margin: 0 auto;
  padding: 2rem 1.5rem;
  background: linear-gradient(180deg, rgba(248, 250, 248, 0.5) 0%, #ffffff 100%);
  min-height: 100vh;
}

.admin-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid var(--color-border);
}

.admin-title {
  font-family: var(--font-heading);
  font-size: 2rem;
  font-weight: 700;
  color: var(--color-primary);
  margin: 0;
  letter-spacing: -0.02em;
}

.refresh-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.625rem 1.25rem;
  background: var(--color-primary);
  color: #fff;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  font-size: 0.9375rem;
  cursor: pointer;
  transition: all var(--duration-fast);
}

.refresh-btn:hover:not(:disabled) {
  background: var(--color-primary-dark);
  transform: translateY(-1px);
}

.refresh-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.refresh-btn svg {
  flex-shrink: 0;
}

.error-banner {
  background: #fef2f2;
  border: 2px solid #fecaca;
  border-radius: 10px;
  padding: 1rem 1.25rem;
  color: #dc2626;
  margin-bottom: 1.5rem;
}

.loading-state,
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  color: var(--color-body-muted);
}

.empty-state svg {
  color: var(--color-border);
  margin-bottom: 1rem;
}

.empty-state h3 {
  font-family: var(--font-heading);
  font-size: 1.5rem;
  color: var(--color-body);
  margin: 0 0 0.5rem;
}

.donations-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.stat-card {
  background: #fff;
  border: 2px solid var(--color-border);
  border-radius: 12px;
  padding: 1.5rem;
  text-align: center;
}

.stat-value {
  font-family: var(--font-heading);
  font-size: 2rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: 0.5rem;
}

.stat-label {
  font-size: 0.875rem;
  color: var(--color-body-muted);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  font-weight: 600;
}

.donations-table-wrapper {
  background: #fff;
  border: 2px solid var(--color-border);
  border-radius: 12px;
  overflow: hidden;
  overflow-x: auto;
}

.donations-table {
  width: 100%;
  border-collapse: collapse;
}

.donations-table thead {
  background: var(--color-bg-alt);
}

.donations-table th {
  padding: 1rem;
  text-align: left;
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 0.875rem;
  color: var(--color-body);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  border-bottom: 2px solid var(--color-border);
}

.donations-table td {
  padding: 1rem;
  border-bottom: 1px solid var(--color-border);
  color: var(--color-body);
  font-size: 0.9375rem;
}

.donations-table tbody tr:hover {
  background: var(--color-bg-alt);
}

.donations-table tbody tr:last-child td {
  border-bottom: none;
}

.donor-name {
  font-weight: 600;
  color: var(--color-primary);
}

.amount {
  font-weight: 700;
  color: var(--color-primary);
  font-family: var(--font-heading);
}

.payment-badge {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  background: var(--color-bg-alt);
  border-radius: 6px;
  font-size: 0.8125rem;
  font-weight: 600;
  color: var(--color-body);
}

.status-badge {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  border-radius: 6px;
  font-size: 0.8125rem;
  font-weight: 600;
}

.status-badge.pending {
  background: #fef3c7;
  color: #92400e;
}

.status-badge.acknowledged {
  background: #d1fae5;
  color: #065f46;
}

@media (max-width: 768px) {
  .donations-admin {
    padding: 1.5rem 1rem;
  }

  .admin-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .admin-title {
    font-size: 1.5rem;
  }

  .donations-stats {
    grid-template-columns: 1fr;
  }

  .donations-table {
    font-size: 0.875rem;
  }

  .donations-table th,
  .donations-table td {
    padding: 0.75rem 0.5rem;
  }
}
</style>
