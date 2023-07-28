import { createWebHashHistory, createRouter } from "vue-router";
import home from './pages/home.vue';
import login from './pages/login.vue';
import register from './pages/register.vue';
import create from './pages/create.vue';
import edit from './pages/edit.vue';

const routes = [
    {
        path: '/',
        name: 'Login',
        component: login
    },
    {
        path: '/home',
        name: 'Home',
        component: home
    },
    {
        path: '/register',
        name: 'Register',
        component: register
    },
    {
        path: '/create',
        name: 'Create',
        component: create
    },
    {
        path: '/edit/:id',
        name: 'Edit',
        component: edit
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;