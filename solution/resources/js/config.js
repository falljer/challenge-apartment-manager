import VueRouter from 'vue-router';
import AuthBearerToken from '@websanova/vue-auth/drivers/auth/bearer.js';
import AuthAxiosHttp from '@websanova/vue-auth/drivers/http/axios.1.x.js';
import AuthRouter from '@websanova/vue-auth/drivers/router/vue-router.2.x';
import Dashboard from '@components/Dashboard.vue';
import Home from '@components/Home.vue';
import Register from '@components/Register.vue';
import Login from '@components/Login.vue';
import Apartment from '@components/Apartment.vue';
import Apartments from '@components/Apartments.vue';
import ApartmentManage from '@components/ApartmentManage.vue';
import Users from '@components/Users.vue';
import UserManage from '@components/UserManage.vue';

const routes = [
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
    },
    {
        path: '/apartments',
        name: 'apartments',
        component: Apartments,
        meta: {
            auth: true
        }
    },
    {
        path: '/apartment',
        name: 'apartment',
        component: Apartment,
        meta: {
            auth: true
        }
    },
    {
        path: '/manage',
        name: 'manage',
        component: ApartmentManage,
        meta: {
            auth: true,
            role: ['admin', 'realtor']
        }
    },
    {
        path: '/users',
        name: 'users',
        component: Users,
        meta: {
            auth: true,
            role: ['admin'],
            showInMenu: true
        }
    },
    {
        path: '/user',
        name: 'user',
        component: UserManage,
        meta: {
            auth: true,
            role: ['admin']
        }
    }
];

const router = new VueRouter({
    routes: routes
});

const config = {
    routes: routes,
    router: router,
    apiBaseURL: 'http://localhost:8000/api',
    authToken: AuthBearerToken,
    authHttp: AuthAxiosHttp,
    authRouter: AuthRouter
};
export default config;
