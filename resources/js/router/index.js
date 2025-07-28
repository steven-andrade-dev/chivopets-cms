import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../views/Login.vue';
import Sections from '../views/Sections.vue';
import Content from '../views/Content.vue';
import Carrusel from '../views/Carrusel.vue';
import Questions from '../views/Questions.vue';
import Cases from '../views/Cases.vue';
import Tips from '../views/Tips.vue';
const routes = [
    {
        path: '/',
        redirect: '/login',
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: { hideNavbar: true },
    },
    {
        path: '/home',
        name: 'home',
        component: Home,
    },
    {
        path: '/sections',
        name: 'sections',
        component: Sections,
    },
    {
        path: '/content',
        name: 'content',
        component: Content,
    },
    {
        path: '/carrusel',
        name: 'carrusel',
        component: Carrusel,
    },
    {
        path: '/questions',
        name: 'questions',
        component: Questions,
    },
    {
        path: '/cases',
        name: 'cases',
        component: Cases,
    },
    {
        path: '/tips',
        name: 'tips',
        component: Tips,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
