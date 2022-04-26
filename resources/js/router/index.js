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
