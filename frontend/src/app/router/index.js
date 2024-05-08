import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('@/pages/home-page/HomePage.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () =>
        import('@/pages/auth-pages/register-page/RegisterPage.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/pages/auth-pages/login-page/LoginPage.vue')
    }
  ]
});

export default router;
