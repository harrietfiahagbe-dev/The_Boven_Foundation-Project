import './bootstrap';
import { createApp } from 'vue';
import DonationsAdmin from './components/DonationsAdmin.vue';
import axios from 'axios';

axios.defaults.baseURL = '/api';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = createApp(DonationsAdmin);
app.mount('#admin-app');
