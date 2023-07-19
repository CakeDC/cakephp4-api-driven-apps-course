import Vue from "vue";
import VueRouter from "vue-router";
import AboutView from "@/views/AboutView.vue";
import PeopleView from "@/views/PeopleView.vue";
import HomeView from "@/views/HomeView.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "home",
        component: HomeView,
    },
    {
        path: "/about",
        name: "about",
        component: AboutView,
    },
    {
        path: "/people",
        name: "people",
        component: PeopleView,
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;
