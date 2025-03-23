import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import HomeView from "../views/HomeView.vue";
import StudentCreate from "@/views/StudentCreate.vue";
import StudentEdit from "@/views/StudentEdit.vue";
import StudentView from "@/views/StudentView.vue";

const routes: Array<RouteRecordRaw> = [
    {
        path: "/",
        name: "home",
        component: HomeView,
    },
    {
        path: "/create-student",
        name: "StudentCreate",
        component: StudentCreate,
    },
    {
        path: "/edit-estudent/:id",
        name: "StudentEdit",
        component: StudentEdit,
    },
    {
        path: "/view-student/:id",
        name: "StudentView",
        component: StudentView,
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL), // Cambiar a createWebHistory
    routes,
});

export default router;
