import Vue from 'vue';
import Auth from '../Auth.js';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import Dashboard from '../components/Dashboard.vue';
const AllUsers = () => import('../components/AllUsers.vue')
const CreateUser = () => import('../components/CreateUser.vue')

const routes = [
    {
        path: '/login',
        component: Login,
        name: "Login"
    },
    {
        path: '/register',
        component: Register,
        name: "Register"
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: "Dashboard",
        meta: { requiresAuth: true }
    },
    {
        path: '/users',
        component: AllUsers,
        name: "AllUsers",
        meta: { requiresAuth: true }
        
    },
    {
        path: '/create',
        component: CreateUser,
        name: "CreateUser",
        meta: { requiresAuth: true }
    },
    {
        path:'*',
        redirect:'/login',
        component: Login,
        name: "Login"
    }
];

 const router = new VueRouter({
     mode: 'history',
     routes: routes
 });

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) ) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push({path: '/login'});
        }
    } else {
        next();
    }
});

export default router;