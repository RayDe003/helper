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
    },
    {
      path: '/plans',
      name: 'plans',
      component: () => import('@/pages/plans-page/PlansPage.vue'),
      redirect: '/plans/today',
      children: [
        {
          path: 'today',
          component: () => import('@/components/plans/plans-today/PlansToday.vue')
        },
        {
          path: 'weeks',
          component: () => import('@/components/plans/plans-weeks/PlansWeeks.vue')
        },
        {
          path: 'calendar',
          component: () => import('@/components/plans/plans-calendar/PlansCalendar.vue')
        }
      ]
    }
  ]
});

export default router;
