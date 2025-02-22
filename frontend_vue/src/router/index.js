import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    // ...existing routes...
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL), // Asegúrate de usar createWebHistory
    routes
})

export default router
