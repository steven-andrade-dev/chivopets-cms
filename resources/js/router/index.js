import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../views/Login.vue';
import Sections from '../views/Sections.vue';
import Content from '../views/Content/Content.vue';
import Carrusel from '../views/Carrusel.vue';
import Questions from '../views/Questions.vue';
import Cases from '../views/Cases/Cases.vue';
import Tips from '../views/Tips.vue';
import Language from '../views/lenguage.vue';
import EditContent from '../views/Content/EditContent.vue';
import User from '../views/User.vue';
import Rol from '../views/Rol.vue';
import Main from '../views/Main.vue';

const routes = [
    {
        path: '/',
        redirect: '/login',
    },
     {
        path: '/lenguage',
        name: 'lenguage',
        component: Language,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: { hideNavbar: true },
    },
    {
        path: '/main',
        name: 'main',
        component: Main,
    },
    {
        path: '/roles',
        name: 'roles',
        component: Rol,
    },

    {
        path: '/home',
        name: 'home',
        component: Home,
        meta: { requiresAuth: true }
    },
    {
        path: '/user',
        name: 'user',
        component: User,
    },
    {
        path: '/sections',
        name: 'sections',
        component: Sections,
    },
    {
        path: '/content/:id?',
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
    {
        path: '/edit-content/:id',
        name: 'edit-content',
        component: EditContent,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("auth_token")

  if ((to.path === '/' || to.path === '/login') && token) {
    next('/home')
  } else if (to.meta.requiresAuth && !token) {
    next('/login')
  } else {
    next()
  }
})

export default router;
