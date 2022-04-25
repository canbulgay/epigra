import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import CapsuleIndex from "../views/capsules/Index.vue";
import CapsuleShow from "../views/capsules/Show.vue";
import Register from "../views/auth/Register.vue";
import Login from "../views/auth/Login.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/about",
        name: "About",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import(/* webpackChunkName: "about" */ "../views/About.vue"),
    },
    {
        path: "/capsules",
        name: "Capsules",
        component: CapsuleIndex,
    },
    {
        path: "/capsules/:capsule_serial",
        name: "Capsule",
        component: CapsuleShow,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;
