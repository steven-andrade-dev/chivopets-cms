import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import './jquery.min.js';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import './sb-admin-2.min.js';

// CSS
import '../css/sb-admin-2.min.css';
import '../css/font/all.min.css';

createApp(App).use(router).mount('#app');
