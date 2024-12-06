import { createRouter, createWebHistory } from "vue-router";
import user from "./user";
import auth from "../stores/auth";

const routes = [
    ...user,
];

const router = createRouter({
	history: createWebHistory(),
	routes,
	strict: true,
});

router.beforeEach((to, from, next) => {
    const authStore = auth();
    // to.meta.requiresAuth && 
    if (to.meta.requiresAuth && !authStore.user.id) {
        next({ name: 'login', query: { redirect: to.fullPath, ...to.query }});
    } else {
        next();
    }
});


export default router;
