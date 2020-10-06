import Vue from 'vue'
import VueRouter from 'vue-router'
import loginadmin from "../components/admin/loginadmin.vue";
import admin from "../components/admin/admin.vue";
import Teams from "../components/admin/Teams";
import Judges from "../components/admin/Judges";
import Spots from "../components/admin/Spots";


Vue.use(VueRouter);

const routes = [
    {
        path: '/blackroom',
        name: 'Login',
        component: loginadmin
    },
    {
        path: '/blackroom/dashboard',
        name: 'dashboard',
        component: admin,
        children: [
            {path: 'equipes', name: 'teams', component: Teams},
            {path: 'jurys', name: 'judges', component: Judges},
            {path: 'plateaux', name: 'spots', component: Spots},
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router
