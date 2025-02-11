import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/Pages/Home.vue';
import About from '@/Pages/About.vue';
import NotFound from '@/Pages/NotFound.vue';
import Product from '@/Pages/Product.vue';
import Index from '@/Pages/Index.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/product/:id', component: Product },
    { path: '/index/:uid?', component: Index },
    { path: '/tasks', component: () => import('@/Pages/Tasks.vue') },
    { path: '/:pathMatch(.*)*', component: NotFound }
  ]
});

export default router;