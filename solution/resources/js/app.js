/* Library Imports */
import config from './config';
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueAuth from '@websanova/vue-auth';

/* Import App */
import App from './App.vue';

/* Vue.js Setup */
Vue.router = config.router;
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueAuth, {
    auth: config.authToken,
    http: config.authHttp,
    router: config.authRouter
});
Vue.config.devtools = true;
Vue.config.debug = true;
Vue.config.silent = false;
axios.defaults.baseURL = config.apiBaseURL;
App.router = Vue.router;

/* Start Vue.js */
new Vue(App).$mount('#app');
