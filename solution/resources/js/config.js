import VueRouter from 'vue-router';
import AuthBearerToken from '@websanova/vue-auth/drivers/auth/bearer.js';
import AuthAxiosHttp from '@websanova/vue-auth/drivers/http/axios.1.x.js';
import AuthRouter from '@websanova/vue-auth/drivers/router/vue-router.2.x';
import Dashboard from '@components/Dashboard.vue';
import Home from '@components/Home.vue';
import Register from '@components/Register.vue';
import Login from '@components/Login.vue';

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                auth: true
            }
        }
    ]
});

const config = {
    router: router,
    apiBaseURL: 'http://localhost:8000/api',
    authToken: AuthBearerToken,
    authHttp: AuthAxiosHttp,
    authRouter: AuthRouter
};
export default config;
