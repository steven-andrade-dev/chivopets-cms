import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';
import InputComponent from './components/InputComponent.vue'
import SelectComponent from './components/SelectComponent.vue'
import PaginationComponent from './components/Pagination.vue'
import LanguageComponent from './components/LanguageSelect.vue'

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import './jquery.min.js';
import './bootstrap.bundle.min.js';
import './sb-admin-2.min.js';

// CSS
import '../css/sb-admin-2.min.css';
import '../css/font/all.min.css';

const app = createApp(App);

app.component('InputComponent', InputComponent)
app.component('SelectComponent', SelectComponent)
app.component('PaginationComponent', PaginationComponent)
app.component('LanguageSelect', LanguageComponent)

app.use(router).mount('#app');
