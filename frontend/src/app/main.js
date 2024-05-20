import '@/assets/css/reset.css';
import '@vuepic/vue-datepicker/dist/main.css';

import { createPinia } from 'pinia';
import { createApp } from 'vue';
import VueCookies from 'vue3-cookies';

import App from './App.vue';
import router from './router';

const pinia = createPinia();
const app = createApp(App);

app.use(VueCookies, {
  secure: true
});
app.use(pinia);
app.use(router);
app.mount('#app');
