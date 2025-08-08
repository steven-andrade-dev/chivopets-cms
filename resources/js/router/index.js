import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Sections from '../views/Sections.vue';
import Content from '../views/Content/Content.vue';
import Questions from '../views/Questions/Questions.vue';
import Cases from '../views/Cases/Cases.vue';
import Tips from '../views/Tips.vue';
import Language from '../views/lenguage.vue';
import EditContent from '../views/Content/EditContent.vue';
import EditSubmenu from '../views/Menu/EditSubmenu.vue';
import User from '../views/User.vue';
import Rol from '../views/Rol.vue';
import Menu from '../views/Menu/Menu.vue';
import NotFound from '../views/NotFound.vue';
import EditQuestion from '../views/Questions/Edit-question.vue';
import Log from '../views/Log/index.vue';
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
        path: '/menu',
        name: 'menu',
        component: Menu,
    },
    {
        path: '/roles',
        name: 'roles',
        component: Rol,
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
        path: '/edit-submenu/:id',
        name: 'edit-submenu',
        component: EditSubmenu,
    },

    {
        path: '/edit-content/:id',
        name: 'edit-content',
        component: EditContent,
    },
    {
        path: '/edit-question/:id',
        name: 'edit-question',
        component: EditQuestion,
    },
    {
        path: '/logs',
        name: 'logs',
        component: Log,
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("auth_token")

  if ((to.path === '/' || to.path === '/login') && token) {
    next('/sections')
  } else if (to.meta.requiresAuth && !token) {
    next('/login')
  } else {
    next()
  }
})

export default router;
