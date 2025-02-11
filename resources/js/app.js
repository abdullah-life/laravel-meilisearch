import { createApp } from "vue";

import app from "@/Layouts/app.vue";

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createApp(app).mount("#app");
