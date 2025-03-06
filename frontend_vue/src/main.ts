import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import 'bootstrap/dist/css/bootstrap.css'
import { Temporal } from 'temporal-polyfill'
import '@fortawesome/fontawesome-free/css/all.css'; // Importa los estilos de Font Awesome
import '@/assets/css/global.css'

createApp(App).use(store).use(router).mount('#app')

import 'bootstrap/dist/js/bootstrap'